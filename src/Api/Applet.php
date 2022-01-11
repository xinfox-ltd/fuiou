<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Api;

use XinFox\Fuiou\Exceptions\FuiouException;
use XinFox\Fuiou\Entity;
use XinFox\Fuiou\Entity\QueryGoodsDetail;
use XinFox\Fuiou\Entity\ShopTable;

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
     * @throws FuiouException
     */
    public function addOrder(array $content)
    {
        $orderNo = $this->post('addOrder', $content);
        if ($orderNo === null) {
            throw new FuiouException('订单已存在');
        }
        return $orderNo;
    }

    /**
     * 更新订单状态
     * @param string $thirdOrderNo 三方订单号
     * @param string $status 订单状态 01 已创建02 已支付待商户接单03 已接单待配送 04 配送中 05 已收货待评价06 已评价 00 订单已取消 99 订单线下退款中
     * @param string $orderCancelReason 快递状态 0 处理 1:待快递员接单 2:快递员已接单待取货 3:快递员配送中 4:已完成 5:已取消 9:快递异常'
     * @param string $thirdOrderStatus 订单取消原因（取消时必填）
     * @return array
     * @throws FuiouException
     */
    public function updateOrder(
        string $thirdOrderNo,
        string $status,
        string $orderCancelReason = '',
        string $thirdOrderStatus = ''
    ): array {
        $content = array(
            'thirdOrderNo' => $thirdOrderNo,
            'status' => $status,
            'thirdOrderStatus' => $thirdOrderStatus,
            'orderCancelReason' => $orderCancelReason,
        );
        return $this->post('updateOrder', $content);
    }

    /**
     * @param int $thirdOrderNo
     * @param string $orderRefundReason
     * @return int
     * @throws FuiouException
     */
    public function refundOrderOnAll(int $thirdOrderNo, string $orderRefundReason): int
    {
        return (int)$this->refundOrder($thirdOrderNo, $orderRefundReason, 'all');
    }

    /**
     * @param int $thirdOrderNo
     * @param string $orderRefundReason
     * @param float $partRefundAmt
     * @param array $partRefundGoods
     * @return int
     * @throws FuiouException
     */
    public function refundOrderOnPart(
        int $thirdOrderNo,
        string $orderRefundReason,
        float $partRefundAmt,
        array $partRefundGoods
    ): int {
        return (int)$this->refundOrder(
            $thirdOrderNo,
            $orderRefundReason,
            'part',
            $partRefundAmt,
            $partRefundGoods
        );
    }

    /**
     * 退款接口
     * @param int $thirdOrderNo 三方订单号
     * @param string $orderRefundReason 订单取消原因（取消时必填）
     * @param string $refundType 是 all （全额退款），part（部分退款）
     * @param float $partRefundAmt 部分退款金额
     * @param array $partRefundGoods 部分退款商品名
     * @return int
     * @throws FuiouException
     */
    private function refundOrder(
        int $thirdOrderNo,
        string $orderRefundReason,
        string $refundType,
        float $partRefundAmt = 0,
        array $partRefundGoods = array()
    ): int {
        $content = array(
            'thirdOrderNo' => $thirdOrderNo,
            'status' => '99',
            'thirdOrderStatus' => '8',
            'partRefundAmt' => $partRefundAmt,
            'orderRefundReason' => $orderRefundReason,
            'refundType' => $refundType,
            'partRefundGoods' => $partRefundGoods,
        );
        return (int)$this->post('refundOrder', $content);
    }

    /**
     * 门店绑定接口
     * @param string $shopId 富友系统门店 id
     * @param string $shopName 富友系统门店名
     * @param string $ownShopId 第三方门店 id
     * @param string $ownShopName 第三方门店名字
     * @return array
     * @throws FuiouException
     */
    public function outSysShopBind(
        string $shopId,
        string $shopName,
        string $ownShopId,
        string $ownShopName
    ): array {
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
     * @param int $shopId 富友系统门店 id
     * @param int $ownShopId 第三方门店 id
     * @return array
     * @throws FuiouException
     */
    public function outSysShopUnBind(int $shopId, int $ownShopId): array
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
     * @return array
     * @throws FuiouException
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
     * @return array
     * @throws FuiouException
     */
    public function queryShopList(string $insCd = ''): array
    {
        $content = ['mchntCd' => $this->config['mchnt_cd']];
        if ($insCd) {
            $content = ['insCd' => $insCd];
        }

        return $this->post('queryShopList', $content);
    }

    /**
     * 商品列表查询接口
     * @param int $shopId 门店号
     * @return array
     * @throws FuiouException
     */
    public function queryGoodsList(int $shopId): array
    {
        $content = array(
            'shopId' => $shopId,
            'mchntCd' => $this->getMchntCd()
        );
        return $this->post('queryGoodsList', $content);
    }

    /**
     * 查询小程序渠道商品详情
     * @param int $goodsId
     * @return array
     * @throws FuiouException
     */
    public function queryGoodsDetailByAppletChannel(int $goodsId): array
    {
        return $this->queryGoodsDetail($goodsId, QueryGoodsDetail::CHANNEL_APPLET);
    }

    /**
     * 查询收银机渠道商品详情
     * @param int $goodsId
     * @return array
     * @throws FuiouException
     */
    public function queryGoodsDetailByPOSChannel(int $goodsId): array
    {
        return $this->queryGoodsDetail($goodsId, QueryGoodsDetail::CHANNEL_POS);
    }

    /**
     * 商品详情查询接口
     * @param int $goodsId 商品号
     * @param string $channelType 渠道类型：00：扫码点餐，01:收银机
     * @return array
     * @throws FuiouException
     */
    private function queryGoodsDetail(int $goodsId, string $channelType): array
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
     * @return array
     * @throws FuiouException
     */
    public function pushOrderDeliveryInfo(
        string $thirdOrderNo,
        string $deliveryState,
        string $cancelReason,
        string $deliverName = '',
        string $deliverPhone = ''
    ): array {
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
     * 桌台区域信息查询接口
     *
     * 返回对象
     * areaId String 区域 id
     * areaName String 区域名称
     * tableNum String 桌台数量
     *
     * @param int $shopId
     * @return array
     * @throws \XinFox\Fuiou\Exceptions\FuiouException
     */
    public function queryShopAreaInfoList(int $shopId): array
    {
        return $this->post('queryShopAreaInfoList', ['shopId' => $shopId, 'mchntCd' => $this->config['mchnt_cd']]);
    }

    /**
     * 桌台信息查询接口
     *
     * 返回数据对象
     * seatNum Integer 座位数
     * areaName String 所在区域名称
     * tableNum Integer 桌台数量
     * tableState String 状态 5
     * tableId String 桌台 ID
     *
     * @param int $shopId
     * @param mixed|null $areaId
     * @param mixed|null $tabState
     * @return ShopTable[]
     * @throws \XinFox\Fuiou\Exceptions\FuiouException
     */
    public function queryShopTabInfoList(int $shopId, $areaId = null, $tabState = null): array
    {
        $rows = $this->post(
            'queryShopTabInfoList',
            ['shopId' => $shopId, 'mchntCd' => $this->config['mchnt_cd'], 'areaId' => $areaId, 'tabState' => $tabState]
        );

        $data = [];
        foreach ($rows as $row) {
            $data[] = new ShopTable($row);
        }

        return $data;
    }

    /**
     * 公共调用接口函数
     * @param string $actionName 接口名称
     * @param array $params 协议参数 注：转义 json 结构
     * @return array|mixed
     * @throws FuiouException
     */
    public function post(string $actionName, array $params)
    {
        foreach ($params as $key => $val) {
            if ($val === null) {
                unset($params[$key]);
            }
        }
        $timestamp = $this->getMicrotime();
        $data = array(
            'timestamp' => $timestamp,
            'secret' => $this->config['secret'],
            'content' => $params,
            'appKey' => $this->config['app_key'],
            'actionName' => $actionName,
        );
        $data['sign'] = $this->sign($actionName, $timestamp, $params);

        $response = $this->curl($this->getApiHost(), $data);

        $status = $response['status'] ?? null;
        $msg = $response['msg'] ?? null;
        if ($status != '0000') {
            throw new FuiouException($msg, (int)$status);
        }
        return $response['data'];
    }


    /**
     * @param string $appid 小程序appid
     * @param string $openid 微信openid
     * @param float $total 支付金额
     * @param string $notifyUrl 回调地址
     * @param string $payNo 支付编号
     * @param string $payType 支付类型 小程序: js_pay  公众号: let_pay
     * @return array 支付信息˚
     * @throws FuiouException
     */
    public function pay(
        string $appid,
        string $openid,
        float  $total,
        string $notifyUrl,
        string $payNo,
        string $payType = 'js_pay'
    ): array {
        // TODO 放置配置文件
        $baseUrl  = 'http://pay.beejian.com/index';
        $prefixNo = '1434';
        $payNo = $prefixNo . $payNo;

        $url = "{$baseUrl}/{$payType}?total={$total}&mchnt_order_no={$payNo}&mchnt_cd={$this->config['mchnt_cd']}&notify_url={$notifyUrl}&sub_openid={$openid}&sub_appid={$appid}";
        $res = json_decode(file_get_contents($url), true);

        if ($res['status'] != 1) {
            throw new FuiouException($res['info']);
        }

        return $res;
    }

    /**
     * //String sign = Md5Util.get32MD5(appKey + actionName + secret + timestamp +(StringUtil.isNullOrBlank(content) ?"" : content))
     * @param $actionName
     * @param $timestamp
     * @param array $params
     * @return string
     */
    private function sign($actionName, $timestamp, array $params): string
    {
        ksort($params);

        $content = json_encode($params, JSON_UNESCAPED_UNICODE);
        $string = "{$this->config['app_key']}{$actionName}{$this->config['secret']}{$timestamp}{$content}";

        return md5($string);
    }

    /**
     * 获取13位时间戳
     * @return float
     */
    private function getMicroTime(): float
    {
        list($t1, $t2) = explode(' ', microtime());

        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    private function getApiHost(): string
    {
        return $this->test === false ? 'https://scte.fuioupay.com/callBack/open.action' : 'https://scantoeattest.fuiou.com/callBack/open.action';
    }
}
