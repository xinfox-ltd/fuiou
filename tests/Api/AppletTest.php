<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace Api;

use XinFox\Fuiou\Api\Applet;
use PHPUnit\Framework\TestCase;
use XinFox\Fuiou\Exceptions\FuiouException;
use XinFox\Fuiou\Fuiou;

class AppletTest extends TestCase
{
    public function testCreateFuiou(): Fuiou
    {
        /*$config = [
            'mchnt_cd' => '0002900F0623672',
            'app_key' => 'A003310F0002085',
            'secret' => 'uDPBAJngHzXnATJnuC3nqhnA41Esr2PA',
            'salt' => 'uDPBAJngHzXnATJnuC3nqhnA41Esr2PA',
        ];*/
        $config = json_decode('{"salt": "wIxXE4UhWc8ZA68QBIM5TgFuTlxFYMln", "secret": "27e82212-be27-4e58-8cfa-e68c1dc2fd2b", "app_key": "0006110F2731399", "mchnt_cd": "0006110F2731399"}', true);
        $fuiou = new Fuiou($config);

        $this->assertIsObject($fuiou);

        return $fuiou;
    }

    public function testRefundOrderOnPart()
    {

    }

    public function testPushOrderDeliveryInfo()
    {
    }

    /**
     * @depends testCreateFuiou
     */
    public function testAddOrder(Fuiou $fuiou)
    {
        $json = '{
    "thirdPartyOrderNo": "306111041517212",
    "shopId": 60791,
    "orderAmt": 1888888,
    "orderDisAmt": 1000,
    "channelType": "05",
    "orderType": "01",
    "payType": "LETPAY",
    "orderState": "02",
    "payAmt": 1888888,
    "guestsCount": 1,
    "userMemo": "",
    "expressAmt": 1,
    "couponAmt": "",
    "finshTm": "",
    "recUpdTm": "",
    "finshDate": "",
    "orderCancelReason": "",
    "deliverTm": "立即送达",
    "mealCode": "ddddd",
    "thirdMchntIncome": 2,
    "address": {
        "addres": "广西南宁市良庆区",
        "contacterName": "weixiaochao",
        "doorNum": "000",
        "gitu": "121.48161208",
        "mark": "jia",
        "phone": "15177175319",
        "titu": "31.67618799"
    },
    "details": [
        {
            "attributes": [],
            "goodsBasePrice": 1,
            "goodsDisPrice": 1,
            "goodsName": "无折扣菜品",
            "goodsNumber": 1,
            "goodsPayAmt": 1,
            "goodsPrice": 1,
            "newSpecs": [],
            "specExtraPrice": 0
        }
    ]
}';
        $fuiou->applet->addOrder(json_decode($json, true));
    }

    /**
     * @depends testCreateFuiou
     */
    public function testQueryGoodsList(Fuiou $fuiou)
    {
        $array = $fuiou->applet->queryGoodsList(60791);
        var_dump($array);
        $this->assertIsArray($array);
    }

    /**
     * @depends testCreateFuiou
     */
    public function testQueryGoodsDetailByAppletChannel(Fuiou $fuiou)
    {
        $array = $fuiou->applet->queryGoodsDetailByAppletChannel(681844798);
        var_dump($array);
        $this->assertIsArray($array);
    }

    public function testQueryOrderByOrderNo()
    {
    }

    public function testOutSysShopBind()
    {
    }

    /**
     * @depends testCreateFuiou
     * @throws \XinFox\Fuiou\Exceptions\FuiouException
     * @throws \XinFox\Fuiou\Exceptions\InvalidArgumentException
     */
    public function testQueryShopAreaInfoList(Fuiou $fuiou)
    {
        $array = $fuiou->applet->queryShopAreaInfoList(22278);
var_dump($array);
        $this->assertIsArray($array);
    }

    public function testUpdateOrder()
    {
    }

    public function testOutSysShopUnBind()
    {
    }

    public function testRefundOrderOnAll()
    {
    }

    /**
     * @depends testCreateFuiou
     * @throws \XinFox\Fuiou\Exceptions\FuiouException
     * @throws \XinFox\Fuiou\Exceptions\InvalidArgumentException
     */
    public function testQueryShopTabInfoList(Fuiou $fuiou)
    {
        $result = $fuiou->applet->queryShopTabInfoList(22302);
        $this->assertIsArray($result);
    }

    public function testQueryGoodsDetailByPOSChannel()
    {
    }

    /**
     * @depends testCreateFuiou
     */
    public function testQueryShopList(Fuiou $fuiou)
    {
        $result = $fuiou->applet->queryShopList();
        var_dump($result);
        $this->assertIsArray($result);
    }
}
