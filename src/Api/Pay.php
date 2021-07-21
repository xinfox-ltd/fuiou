<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Api;

use XinFox\Fuiou\Exceptions\FuiouException;

/**
 * 上海富有支付 -- 支付接口 (普通商户支付)
 * Class Pay
 * @package XinFox\Fuiou\Api
 */
class Pay extends Api
{
    // 请求参数
    private array $requestParams = [];

    // 支付通道
    private int $payChannel = 1;

    // 测试支付环境
    private const TEST_PAY_CHANCEL = 'https://aipaytest.fuioupay.com';

    // 正式支付环境 双通道
    private const PAY_CHANNEL = [
        1 => 'https://aipay.fuioupay.com',
        2 => 'https://aipay-xs.fuioupay.com',
    ];

    // 应答码
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
     * 发起支付
     *
     * @return  Array   [return description]
     */
    public function pay(): Array
    {
        return $this->request('/aggregatePay/wxPreCreate', [
            'mchnt_cd', 'trade_type', 'order_amt', 'mchnt_order_no',
            'txn_begin_ts', 'goods_des', 'term_id', 'term_ip',
            'notify_url', 'random_str', 'version'
        ], [
            'result_code', 'result_msg', 'mchnt_cd',
            'reserved_fy_trace_no', 'random_str'
        ]);
    }

    /**
     * 发起退款
     *
     * @return  Array   [return description]
     */
    public function refund(): Array
    {
        return $this->request('/aggregatePay/commonRefund', [
            'mchnt_cd', 'order_type', 'mchnt_order_no', 'refund_order_no',
            'total_amt', 'refund_amt', 'term_id', 'random_str', 'version'
        ], [
            'result_code', 'mchnt_cd', 'mchnt_order_no', 'refund_order_no',
            'reserved_fy_settle_dt', 'random_str'
        ]);
    }

    /**
     * 订单查询
     *
     * @return  Array   [return description]
     */
    public function order(): Array
    {
        return $this->request('/aggregatePay/commonQuery', [
            'mchnt_cd', 'order_type', 'mchnt_order_no',
            'term_id', 'random_str', 'version'
        ], [
            'result_code', 'result_msg', 'mchnt_cd',
            'order_amt', 'transaction_id', 'mchnt_order_no',
            'reserved_fy_settle_dt', 'trans_stat', 'random_str'
        ]);
    }

    /**
     * 支付结果签名验证
     *
     * @param   array  $responseData  [$responseData description]
     *
     * @return  Bool                  [return description]
     */
    public function verify(array $responseData = []): Bool
    {
        if (empty($responseData)) throw new FuiouException('缺少响应参数');

        // sign or fullSign 其中一个为true即认为验签通过
        $sign = md5("{$this->config['mchnt_cd']}|{$responseData['mchnt_order_no']}|{$responseData['settle_order_amt']}|{$responseData['order_amt']}|{$responseData['txn_fin_ts']}|{$responseData['reserved_fy_settle_dt']}|{$responseData['random_str']}|{$this->config['mchnt_key']}");
        $fullSign = md5("{$responseData['result_code']}|{$responseData['result_msg']}|{$responseData['mchnt_cd']}|{$responseData['mchnt_order_no']}|{$responseData['settle_order_amt']}|{$responseData['order_amt']}|{$responseData['txn_fin_ts']}|{$responseData['reserved_fy_settle_dt']}|{$responseData['random_str']}|{$this->config['mchnt_key']}");

        // 签名验证比对
        if ($responseData['sign'] !== $sign && $responseData['full_sign'] !== $fullSign) {

            // 不保证通知最终一定能成功，在订单状态不明或者没有收到微信，支付结果通知的情况下，建议商户主动调用【订单查询】确认订单状态）
            // 只有主扫、公众号/服务窗支付会通过此接口发异步通知，条码支付没有异步通知。
            throw new FuiouException('签名错误'); // 建议主动调用[订单查询]接口再次确认订单状态!!!
        }

        return true;
    }

    /**
     * 设置请求参数
     *
     * @param   [type]  $key    [$key description]
     * @param   [type]  $value  [$value description]
     *
     * @return  Pay             [return description]
     */
    public function setRequestParams($key, $value): Pay
    {
        $this->requestParams[$key] = $value;
        return $this;
    }

    /**
     * 获取参数
     *
     * @param   [type]  $key  [$key description]
     *
     * @return  String        [return description]
     */
    public function getRequestParams($key): String
    {
        return $this->requestParams[$key];
    }

    /**
     * 清空请求参数
     *
     * @return  Pay     [return description]
     */
    public function emptyRequestParams(): Pay
    {
        $this->requestParams = [];
        return $this;
    }

    /**
     * 移除某个参数
     *
     * @param   [type]  $key  [$key description]
     *
     * @return  Pay           [return description]
     */
    public function removeRequestParam($key): Pay
    {
        unset($this->requestParams[$key]);
        return $this;
    }

    /**
     * 设置支付通道
     *
     * @param   [type]  $channel  [$channel description]
     *
     * @return  Pay               [return description]
     */
    public function setChannel($channel = 1): Pay
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
     * 获取一个随机字符串
     *
     * @param   [type]  $len  [$len description]
     *
     * @return  String        [return description]
     */
    public function getRandomStr($len = 32): String
    {
        $chars = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
            "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
            "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
            "3", "4", "5", "6", "7", "8", "9",
        );

        $charsLen = count($chars) - 1;
        shuffle($chars);

        $output = '';
        for ($i = 0; $i < $len; $i++) {
            $output .= $chars[mt_rand(0, $charsLen)];
        }
        return $output;
    }

    /**
     * 数据请求
     *
     * @param   string  $action        请求接口
     * @param   array   $signParams    签名参数字段
     * @param   array   $signResponse  响应参数签名字段
     *
     * @return  Array                  [return description]
     */
    private function request(string $action, array $signParams = [], array $signResponse = []): Array
    {
        // 设置统一公共参数
        $this->setRequestParams('mchnt_cd', $this->config['mchnt_cd']);
        $this->setRequestParams('random_str', $this->getRandomStr());

        // 请求字符串签名
        $signStr = '';
        if (!empty($signParams)) {
            foreach ($signParams as $param) {
                $signStr .= $this->requestParams[$param] . '|';
            }
        }
        $signStr .= $this->config['pay_mchnt_key'];
        $this->requestParams['sign'] = md5($signStr);
        $response = $this->curl($this->getApiHost() . $action, $this->requestParams);

        if (empty($response)) {
            throw new FuiouException('无数据返回');
        }

        if (!$response['result_code']) {
            throw new FuiouException('无数据返回');
        } else if ($response['result_code'] != '000000') {
            throw new FuiouException(self::RESPONSE_CODE[$response['result_code']] . '：' . $response['result_msg'], (int) $response['result_code']);
        }

        // 为了安全起见 响应结果也需要做签名验证 确保数据未被篡改
        $signResponseStr = '';
        if (!empty($signResponse)) {
            foreach ($signResponse as $responseParam) {
                $signResponseStr .= $response[$responseParam] . '|';
            }
        }
        $signResponseStr .= $this->config['pay_mchnt_key'];
        if ($response['sign'] !== md5($signResponseStr)) {
            throw new FuiouException('响应数据异常');
        }

        return $response;
    }
}
