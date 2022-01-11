<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Api\Saas;

use XinFox\Fuiou\Api\Api;
use XinFox\Fuiou\Api\Saas\Traits\SaasTrait;
use XinFox\Fuiou\Exceptions\FuiouException;

/**
 * 上海富有支付--新版SaaS第三方小程序接口 -- 商品类
 * Class Goods
 * @package XinFox\Fuiou\Api\Saas
 */
class Goods extends Api
{
    use SaasTrait;

    /**
     * 批量获取商品详情
     * 
     * @return void
     */
    public function queryGoodsInfoListNew()
    {
        if ($this->issetRequestParams('shopId') === false) {
            throw new FuiouException('shopId 不能为空');
        }
        $this->setRequestParams('mchntCd', $this->getMchntCd());
        return $this->post('queryGoodsInfoListNew', ['shopId']);
    }
}
