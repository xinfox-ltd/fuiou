<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Api;

use XinFox\Fuiou\Exceptions\ApiException;

/**
 * 上海富有支付--SaaS第三方小程序接口
 * Class Applet
 * @package XinFox\Fuiou\Api
 */
class Applet extends Api
{
    /**
     * 下单接口
     * @param array $content
     * $content:{
     *    "thirdPartyOrderNo":"3061005572529515547", //订单号(必填)
     *    "shopId":22304,  //富友门店 id(必填)
     *    "orderAmt":2,  //商品原金额 (必填)
     *    "orderDisAmt":1,  //商品优惠后金额（原价-快递费）(必填)
     *    "channelType":"05", // 详见交易渠道说明(必填)
     *    "orderType":"02", //01 堂食 02 外卖：详见订单类型说明(必填)
     *    "payType":"LETPAY", //支付方式（LETPAY）(必填)
     *    "orderState":"02", //01 已创建 02 已支付待商户接单 03 已接单待配送 04 配送中05 已收货待评价 06已评价 00 已取消 (选填）
     *    "payAmt":2, //实际支付金额(必填)
     *    "guestsCount":1, //就餐人数 (必填)
     *    "userMemo":",  //用户下单备注 (选填）
     *    "expressAmt":1, //快递费 (必填)
     *    "couponAmt":'', 优惠券金额（选填）
     *    "finshTm": '',订单完成时间(必填)
     *    "recUpdTm":'', 最后更新时间(选填)
     *    "finshDate":'', 完成日期(选填)
     *    "orderCancelReason": '', 订单取消原因(选填)
     *    "deliverTm":"立即送达", 预计送达时间(必填)
     *    "mealCode":"1", //取餐码(必填)
     *    "thirdMchntIncome":2, //商家预计收入（店铺实际本)
     *
     *    "address":{  //快递地址信息(必填)
     *    "addres":"广西南宁市良庆区",//详细地址(必填)
     *    "contacterName":"weixiaochao",  //联系人(必填)
     *    "doorNum":"000",  //门牌号(必填)
     *    "gitu":"121.48161208", //用户坐标经度(选填)
     *    "mark":"jia",//标签名称 (选填)
     *    "phone":"15177175319",  //联系人手机(必填)
     *    "titu":"31.67618799"  //用户坐标纬度(选填)
     *    },
     *
     *   "details":[
     *   {
     *    "attributes":[
     *    ],
     *   "goodsBasePrice":1,
     *   "goodsDisPrice":1,
     *   "goodsName":"无折扣菜品",
     *   "goodsNumber":1,
     *   "goodsPayAmt":1,
     *   "goodsPrice":1,
     *   "newSpecs":[
     *    ],
     *    "specExtraPrice":0
     *    }
     *    ],
     *
     * }
     * @return mixed
     * @throws ApiException
     */
    public function addOrder(array $content)
    {
        return $this->post('addOrder', $content);
    }

    /**
     * 更新订单状态
     * @param string $thirdOrderNo 三方订单号
     * @param string $status 订单状态 01 已创建02 已支付待商户接单03 已接单待配送 04 配送中 05 已收货待评价06 已评价 00 订单已取消 99 订单线下退款中
     * @param string $orderCancelReason 快递状态 0 处理 1:待快递员接单 2:快递员已接单待取货 3:快递员配送中 4:已完成 5:已取消 9:快递异常'
     * @param string $thirdOrderStatus 订单取消原因（取消时必填）
     * @return mixed
     * @throws ApiException
     */
    public function updateOrder(
        string $thirdOrderNo,
        string $status,
        string $orderCancelReason = '',
        string $thirdOrderStatus = ''
    ) {
        $content = array(
            'thirdOrderNo' => $thirdOrderNo,
            'status' => $status,
            'thirdOrderStatus' => $thirdOrderStatus,
            'orderCancelReason' => $orderCancelReason,
        );
        return $this->post('updateOrder', $content);
    }

    /**
     * 退款接口
     * @param string $thirdOrderNo 三方订单号
     * @param string $status 订单状态 99 取消
     * @param string $thirdOrderStatus 快递状态 8:客户发起退款请求需收银机商户端确认。
     * @param string $orderRefundReason 订单取消原因（取消时必填）
     * @param string $refundType 是 all （全额退款），part（部分退款）
     * @param float $partRefundAmt 部分退款金额
     * @param array $partRefundGoods 部分退款商品名
     * @return mixed
     * @throws ApiException
     */
    public function refundOrder(
        string $thirdOrderNo,
        string $status,
        string $thirdOrderStatus,
        string $orderRefundReason,
        string $refundType,
        float $partRefundAmt = 0,
        array $partRefundGoods = array()
    ) {
        $content = array(
            'thirdOrderNo' => $thirdOrderNo,
            'status' => $status,
            'thirdOrderStatus' => $thirdOrderStatus,
            'partRefundAmt' => $partRefundAmt,
            'orderRefundReason' => $orderRefundReason,
            'refundType' => $refundType,
            'partRefundGoods' => $partRefundGoods,
        );
        return $this->post('refundOrder', $content);
    }

    /**
     * 门店绑定接口
     * @param string $shopId 富友系统门店 id
     * @param string $shopName 富友系统门店名
     * @param string $ownShopId 第三方门店 id
     * @param string $ownShopName 第三方门店名字
     * @return mixed
     * @throws ApiException
     */
    public function outSysShopBind(
        string $shopId,
        string $shopName,
        string $ownShopId,
        string $ownShopName
    ) {
        $content = array(
            'shopId' => $shopId,
            'shopName' => $shopName,
            'ownShopId' => $ownShopId,
            'ownShopName' => $ownShopName,
            'mchntCd' => $this->config['mchnt_cd']
        );
        return $this->post('outSysShopBind', $content);
    }

    /**
     * 门店解绑接口
     * @param string $shopId 富友系统门店 id
     * @param string $ownShopId 第三方门店 id
     * @return mixed
     * @throws ApiException
     */
    public function outSysShopUnBind(string $shopId, string $ownShopId)
    {
        $content = array(
            'shopId' => $shopId,
            'ownShopId' => $ownShopId,
            'mchntCd' => $this->config['mchnt_cd']
        );
        return $this->post('outSysShopUnBind', $content);
    }

    /**
     * 订单查询接口
     * @param string $orderNo 订单号
     * @return mixed
     * @throws ApiException
     */
    public function queryOrderByOrderNo(string $orderNo): array
    {
        $content = array(
            'orderNo' => $orderNo,
            'mchntCd' => $this->config['mchnt_cd']
        );
        return $this->post('queryOrderByOrderNo', $content);
    }

    /**
     * 门店列表查询接口
     * @param string $insCd 订单号
     * @return mixed
     * @throws ApiException
     */
    public function queryShopList(string $insCd = ''): array
    {
        if ($insCd) {
            $content = array(
                'insCd' => $insCd
            );
        } else {
            $content = array(
                'mchntCd' => $this->config['mchnt_cd']
            );
        }
        return $this->post('queryShopList', $content);
    }

    /**
     * 商品列表查询接口
     * @param int $shopId 门店号
     * @return mixed
     * @throws ApiException
     */
    public function queryGoodsList(int $shopId)
    {
        $content = array(
            'shopId' => $shopId,
            'mchntCd' => $this->getMchntCd()
        );
        return $this->post('queryGoodsList', $content);
    }

    /**
     * 商品详情查询接口
     * @param string $goodsId 商品号
     * @param string $channelType 渠道类型：00：扫码点餐，01:收银机
     * @return mixed
     * @throws ApiException
     */
    public function queryGoodsDetail(string $goodsId, string $channelType)
    {
        $content = array(
            'goodsId' => $goodsId,
            'channelType' => $channelType,
            'mchntCd' => $this->config['mchnt_cd']
        );
        return $this->post('queryGoodsDetail', $content);
    }

    /**
     * 接收订单快递信息推送
     * @param string $thirdOrderNo 三方订单号
     * @param string $deliveryState 快递状态 1:待快递员接单 2:快递员已接单待取货 3:快递员配送中 4:已完成 5:已取消 9:快递异常'
     * @param string $cancelReason 快递取消时，必填
     * @param string $deliverName 快递员姓名
     * @param string $deliverPhone 快递员电话
     * @return mixed
     * @throws ApiException
     */
    public function pushOrderDeliveryInfo(
        string $thirdOrderNo,
        string $deliveryState,
        string $cancelReason,
        string $deliverName = '',
        string $deliverPhone = ''
    ) {
        $content = array(
            'thirdOrderNo' => $thirdOrderNo,
            'deliveryState' => $deliveryState,
            'cancelReason' => $cancelReason,
            'deliverName' => $deliverName,
            'deliverPhone' => $deliverPhone
        );
        return $this->post('pushOrderDeliveryInfo', $content);
    }


    /**
     * 公共调用接口函数
     * @param string $actionName 接口名称
     * @param array $content 协议参数 注：转义 json 结构
     * @return mixed
     * @throws ApiException
     */
    public function post(string $actionName, array $content)
    {
        //String sign = Md5Util.get32MD5(appKey + actionName + secret + timestamp +(StringUtil.isNullOrBlank(content) ?"" : content))
        $timestamp = $this->getMillisecond();
        $options = array(
            'timestamp' => $timestamp,
            'secret' => $this->config['secret'],
            'content' => $content,
            'appKey' => $this->config['app_key'],
            'actionName' => $actionName,
        );
        ksort($content);
        $content = json_encode($content, JSON_UNESCAPED_UNICODE);
        $s = "{$this->config['app_key']}{$actionName}{$this->config['secret']}{$timestamp}{$content}";
        $sign = md5($s);
        $options['sign'] = $sign;

        $response = $this->curl($this->appletUrl, $options);

        $status = $response['status'] ?? null;
        $msg = $response['msg'] ?? null;
        if ($status != '0000') {
            throw new ApiException($msg, $status);
        }
        return $response['data'];
    }

    /**
     * 获取13位时间戳
     * @return float
     */
    private function getMillisecond()
    {
        list($t1, $t2) = explode(' ', microtime());

        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }
}