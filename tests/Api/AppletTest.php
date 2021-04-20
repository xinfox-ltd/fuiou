<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace Api;

use XinFox\Fuiou\Api\Applet;
use PHPUnit\Framework\TestCase;
use XinFox\Fuiou\Exceptions\ApiException;
use XinFox\Fuiou\Fuiou;

class AppletTest extends TestCase
{
    public function testCreateFuiou(): Fuiou
    {
        $config = [
            'mchnt_cd' => '0006110F2731399',
            'app_key' => '0006110F2731399',
            'secret' => '27e82212-be27-4e58-8cfa-e68c1dc2fd2b',
            'salt' => 'wIxXE4UhWc8ZA68QBIM5TgFuTlxFYMln',
        ];
        $fuiou = new Fuiou($config);

        $this->assertIsObject($fuiou);

        return $fuiou->test();
    }

    public function testRefundOrderOnPart()
    {

    }

    public function testPushOrderDeliveryInfo()
    {
    }

    public function testAddOrder()
    {
    }

    public function testQueryGoodsList()
    {
    }

    public function testQueryOrderByOrderNo()
    {
    }

    public function testOutSysShopBind()
    {
    }

    /**
     * @depends testCreateFuiou
     * @throws \XinFox\Fuiou\Exceptions\ApiException
     * @throws \XinFox\Fuiou\Exceptions\InvalidArgumentException
     */
    public function testQueryShopAreaInfoList(Fuiou $fuiou)
    {
        $array = $fuiou->applet->queryGoodsList(607910);

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
     * @throws \XinFox\Fuiou\Exceptions\ApiException
     * @throws \XinFox\Fuiou\Exceptions\InvalidArgumentException
     */
    public function testQueryShopTabInfoList(Fuiou $fuiou)
    {
        $result = $fuiou->applet->queryShopAreaInfoList(60791);
        $this->assertIsArray($result);
    }

    public function testQueryGoodsDetailByPOSChannel()
    {
    }

    public function testQueryGoodsDetailByAppletChannel()
    {
    }

    public function testQueryShopList()
    {
    }
}
