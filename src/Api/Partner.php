<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Api;

use XinFox\Fuiou\Exceptions\FuiouException;
use XinFox\Fuiou\Exceptions\InvalidArgumentException;

/**
 * 上海富有支付 -- 支付接口 (合作方支付)
 * Class Partner
 * @package XinFox\Fuiou\Api
 */
class Partner extends Api
{
    // 请求参数
    private array $requestParams = [];

    // 支付通道
    private int $payChannel = 1;

    // 测试支付环境
    private const TEST_PAY_CHANCEL = 'https://fundwx.fuiou.com';

    // 正式支付环境 双通道
    private const PAY_CHANNEL = [
        1 => 'https://spay-mc.fuioupay.com',
        2 => 'https://spay-xs.fuioupay.com',
    ];

    private const RESPONSE_CODE = [
        // 系统类
        '000000' => '成功',
        '010001' => '请求超时',
        '010002' => '系统异常',
        '010003' => '当前服务不可用',
        '010005' => '系统维护中',
        '010006' => '系统繁忙',
        '010007' => '渠道不可用',
        '010008' => '机构受理异常',

        // 报文类
        '020001' => '报文错误',

        // 交易类 (6位应答码)
        '030001' => '其他错误',
        '030002' => '授权码不正确',
        '030003' => '订单已重复',
        '030004' => '订单已支付',
        '030005' => '商户不存在',
        '030006' => '订单已撤销',
        '030007' => '订单已关闭',
        '030008' => '订单不存在',
        '030009' => '商户无权限',
        '030010' => '用户支付中',
        '030011' => '订单已退款',
        '030012' => '退款订单不存在',
        '030013' => '头寸不足',
        '030014' => '退款金额超过原订单总金额',
        '030015' => '余额不足',
        '030016' => '原订单不存在',
        '030017' => '订单不可退款',
        '030018' => '商户已入驻',
        '030020' => '商户经营类目不存在',

        // 交易类 (4位应答码)
        '1001' => '非空字段出现空值',
        '1002' => '验签错误',
        '1003' => '字段内容错误',
        '1009' => '商户号不存在',
        '1010' => '找不到交易',
        '1011' => '金额超限不允许退款',
        '1012' => '余额不足不允许退款/银联主扫不允许退款',
        '1013' => '商户订单号重复',
        '1014' => '报文格式错',
        '1015' => '请求功能尚不支持',
        '2001' => '目标方超时',
        '2002' => '目标方连接失败',
        '9999' => '系统错误',
    ];

    /**
     * 公众号/服务窗统一下单请求报文
     *
     * @return  Array   [return description]
     */
    public function pay(): Array
    {
        if ($this->issetRequestParams('notify_url') === false) {
            throw new FuiouException('notify_url 不能为空');
        }
        if ($this->issetRequestParams('order_amt') === false) {
            throw new FuiouException('order_amt 不能为空');
        }
        if ($this->issetRequestParams('mchnt_order_no') === false) {
            throw new FuiouException('mchnt_order_no 不能为空');
        }
        if ($this->issetRequestParams('mchnt_order_no') === false) {
            throw new FuiouException('mchnt_order_no 不能为空');
        }
        if ($this->issetRequestParams('mchnt_order_no') === false) {
            throw new FuiouException('mchnt_order_no 不能为空');
        }

        // 初始化默认值
        $this->setRequestParams('limit_pay', '');
        $this->setRequestParams('product_id', '');
        $this->setRequestParams('addn_inf', '');
        $this->setRequestParams('curr_type', '');
        $this->setRequestParams('goods_tag', '');
        $this->setRequestParams('openid', '');
        $this->setRequestParams('mchnt_order_no', $this->config['pay_order_prefix'] . $this->requestParams['mchnt_order_no']);
        $this->setRequestParams('goods_des', $this->requestParams['mchnt_order_no']);
        $this->setRequestParams('txn_begin_ts', date('YmdHis'));

        return $this->request('/wxPreCreate');
    }

    /**
     * 退款申请
     *
     * @return  Array   [return description]
     */
    public function refund(): Array
    {
        if ($this->issetRequestParams('mchnt_order_no') === false) {
            throw new FuiouException('mchnt_order_no 不能为空');
        }
        if ($this->issetRequestParams('order_type') === false) {
            throw new FuiouException('order_type 不能为空');
        }
        if ($this->issetRequestParams('refund_order_no') === false) {
            throw new FuiouException('refund_order_no 不能为空');
        }
        if ($this->issetRequestParams('total_amt') === false) {
            throw new FuiouException('total_amt 不能为空');
        }
        if ($this->issetRequestParams('refund_amt') === false) {
            throw new FuiouException('refund_amt 不能为空');
        }

        return $this->request('/commonRefund');
    }

    /**
     * 订单查询
     * 由于不可抗因素导致交易超时，或者状态不明确时，需要商户主动发起交易查询。来确定交易的最终状态。
     * 目前系统支持往前查询3日的交易。即T-3 到 T 日的交易才能查询到记录。
     * 3日前的交易查询请用[历史订单]接口查询
     * @return  Array   [return description]
     */
    public function order(): Array
    {
        if ($this->issetRequestParams('order_type') === false) {
            throw new FuiouException('order_type 不能为空');
        }
        if ($this->issetRequestParams('mchnt_order_no') === false) {
            throw new FuiouException('mchnt_order_no 不能为空');
        }

        return $this->request('/commonQuery');
    }

    /**
     * 历史订单查询
     * 本接口提供给商户查询历史交易记录。查询实时交易状态、结果(当前交易)须使用[订单查询]接口
     * @return  Array   [return description]
     */
    public function history(): Array
    {
        if (
            $this->issetRequestParams('mchnt_order_no') === false &&
            $this->issetRequestParams('channel_order_id') === false &&
            $this->issetRequestParams('transaction_id') === false
        ) {
            throw new FuiouException('mchnt_order_no、channel_order_id、transaction_id 三选一');
        }
        if ($this->issetRequestParams('order_type') === false) {
            throw new FuiouException('order_type 不能为空');
        }
        
        return $this->request('/hisTradeQuery');
    }

    /**
     * 签名验证
     * 支付回调验签失败后 建议主动调用[订单查询]接口再次确认订单状态
     * @param   array  $responseData  [$responseData description]
     *
     * @return  Bool                  [return description]
     */
    public function verify(array $responseData = []): Bool
    {
        try {
            // 公钥文件必须存在
            if (!isset($this->config['public_pem'])) {

                throw new InvalidArgumentException('The public_pem does not exist');
            }

            $dataStr = '';
            ksort($responseData);

            // 将接口中每一个字段(sign及reserved开头字段除外),以字典顺序排序之后,按照key1=value1&key2=value2.....的顺序,进行拼接。
            // 注：sign及reserved开头字段除外的其他非必填字段也需要参与验签。我司会根据后期业务需求，新增reserved开头字段,请提前做好兼容(简而言之，我们会新增reserved开头字段的字段，这些字段都不参与验签)。
            foreach ($responseData as $key => $value) {
                if (is_array($value) && empty($value)) $value = '';
                if ($key != 'sign' && substr($key, 0, strlen('reserved')) != 'reserved') {
                    $dataStr .= $key . '=' . $value . '&';
                }
            }

            // 签名验证
            $verify = openssl_verify(rtrim($dataStr, '&'), base64_decode(str_replace("\n", "", $responseData['sign'])), $this->pem($this->config['public_pem']), OPENSSL_ALGO_MD5);
            if ($verify === 1) { // 签名正确返回 
                return true;
            } else if ($verify === 0) { // 签名错误返回 0
                return false;
            } else { // 内部发生错误则返回 -1
                throw new FuiouException('Error Checking Signature');
            }
        } catch (\Throwable $e) {
            throw new FuiouException($e->getMessage());
        }
    }

    /**
     * 设置请求参数
     *
     * @param   [type]  $key    [$key description]
     * @param   [type]  $value  [$value description]
     *
     * @return  Partner      [return description]
     */
    public function setRequestParams($key, $value): Partner
    {
        $this->requestParams[$key] = $value;
        return $this;
    }

    /**
     * 检测参数是否设置
     *
     * @param   [type]  $key  [$key description]
     *
     * @return  Bool          [return description]
     */
    public function issetRequestParams($key): Bool
    {
        return isset($this->requestParams[$key]) ? true : false;
    }

    /**
     * 设置支付通道
     *
     * @param   [type]  $channel  [$channel description]
     *
     * @return  Partner        [return description]
     */
    public function setChannel($channel = 1): Partner
    {
        $this->payChannel = $channel;
        return $this;
    }

    /**
     * 获取API接口地址
     *
     * @return  String  [return description]
     */
    public function getApiHost(): String
    {
        if ($this->test) return self::TEST_PAY_CHANCEL;
        if (!isset(self::PAY_CHANNEL[$this->payChannel])) throw new FuiouException('支付接口地址错误');
        return self::PAY_CHANNEL[$this->payChannel];
    }

    /**
     * 数据请求
     *
     * @param   string  $action  [$action description]
     *
     * @return  Array            [return description]
     */
    private function request(string $action): array
    {
        // 设置公共参数
        $this->setRequestParams('version', '1.0');
        $this->setRequestParams('ins_cd', $this->config['ins_cd']);
        $this->setRequestParams('mchnt_cd', $this->config['mchnt_cd']);
        $this->setRequestParams('term_id', '88888888');
        $this->setRequestParams('random_str', md5(uniqid()));
        $this->setRequestParams('sign', $this->sign($this->requestParams));

        $xml = $this->arrToXml($this->requestParams);
        $url = str_replace(' ', '+', $this->getApiHost() . $action);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'req=' . urlencode(urlencode($xml)));
        $output = curl_exec($ch);
        $errorCode = curl_errno($ch);
        curl_close($ch);

        if (0 !== $errorCode) {
            throw new FuiouException('无数据返回');
        }
        $response = $this->objToArr(simplexml_load_string(urldecode($output)));
        if (empty($response)) {
            throw new FuiouException('无数据返回');
        }

        if (!$response['result_code']) {
            throw new FuiouException('无数据返回');
        } else if ($response['result_code'] != '000000') {
            throw new FuiouException(self::RESPONSE_CODE[$response['result_code']] . '：' . $response['result_msg'], (int)$response['result_code']);
        }

        // 为了安全起见 响应结果也需要做签名验证 确保数据未被篡改
        if (!$this->verify((array)$response)) {
            throw new FuiouException('响应数据异常');
        }

        return (array)$response;
    }

    /**
     * 数据签名
     *
     * @param   array   $data  [$data description]
     *
     * @return  String         [return description]
     */
    private function sign(array $data): String
    {
        try {
            // 秘钥文件必须存在
            if (!isset($this->config['private_pem'])) {

                throw new InvalidArgumentException('The private_pem does not exist');
            }

            $dataStr = '';
            // 字典序排序字符串
            ksort($data);
            foreach ($data as $key => $value) {
                $dataStr .= $key . '=' . $value . '&';
            }

            // MD5WithRSA私钥加密
            openssl_sign(rtrim($dataStr, '&'), $sign, $this->pem($this->config['private_pem'], false), OPENSSL_ALGO_MD5);

            // 返回base64加密之后的数据
            return base64_encode($sign);
        } catch (\Throwable $e) {
            throw new FuiouException($e->getMessage());
        }
    }

    /**
     * 获取pem资源
     *
     * @param   [type]$pem     [$pem description]
     * @param   [type]$public  [$public description]
     * @param   true           [ description]
     *
     * @return  [type]         [return description]
     */
    private function pem($pem, $public = true)
    {
        if ($public == false) {
            $pem = wordwrap($pem, 64, "\n", true);
            $pem = "-----BEGIN RSA PRIVATE KEY-----\n{$pem}\n-----END RSA PRIVATE KEY-----\n";
            return openssl_pkey_get_private($pem);
        } else {
            $pem = wordwrap($pem, 64, "\n", true);
            $pem = "-----BEGIN PUBLIC KEY-----\n{$pem}\n-----END PUBLIC KEY-----\n";
            return openssl_pkey_get_public($pem);
        }
    }

    /**
     * 数组转XML
     *
     * @param   [type]  $arr  [$arr description]
     *
     * @return  String        [return description]
     */
    private function arrToXml($arr): String
    {
        $xml = "<?xml version=\"1.0\" encoding=\"GBK\" standalone=\"yes\"?><xml>";
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $xml .= "<" . $key . ">" . $this->arrToXml($val) . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    /**
     * 对象转数组
     *
     * @param   [type]  $obj  [$obj description]
     *
     * @return  [type]        [return description]
     */
    private function objToArr($obj)
    {
        try {
            $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
            $arr = null;
            foreach ($_arr as $key => $val) {
                $val = (is_array($val)) || is_object($val) ? $this->objToArr($val) : $val;
                $arr[$key] = $val;
            }
            return $arr;
        } catch (\Throwable $e) {
            throw new FuiouException($e->getMessage());
        }
    }
}
