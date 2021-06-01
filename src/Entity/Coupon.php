<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Entity;

use XinFox\Fuiou\Entity;

class Coupon extends Entity
{
    /**
     * @var int 优惠券模板 ID
     */
    protected int $couponId;

    /**
     * @var string 商户号
     */
    protected string $merchantCode;

    /**
     * @var string 优惠券名称
     */
    protected string $couponName;

    /**
     * @var string 优惠券类型：00：系统内置优惠券，01：用户创建优惠券，04：微信卡券，05：微信商家券
     */
    protected string $couponType;

    /**
     * @var string 有效天数
     */
    protected string $expDay;

    /**
     * @var string 优惠券状态, 00:正常,01:过期,02:作废,03:未生效,04:已转赠
     */
    protected string $couponState;

    /**
     * @var int 优惠金额 以分为单位
     */
    protected int $couponFee;

    /**
     * @var int 优惠方式:满减金额，eg:满 100 减 5，此字段则为 10000 以分为单位
     */
    protected int $createPer;

    /**
     * @var string 分享状态：00：不能分享，01：允许分享
     */
    protected string $shareState;

    /**
     * @var string 有效方式：00：领券即生效，01：固定起止时间
     */
    protected string $validType;

    /**
     * @var string 优惠券生效时间
     */
    protected string $effTimeStr;

    /**
     * @var string 优惠券失效时间
     */
    protected string $expTimeStr;

    /**
     * @var string 使用限制：00：无限制， 01 ： 收 银机 ， 02 ： 外 卖 ，03：小程序堂食
     */
    protected string $useLimitType;

    /**
     * @var int 优惠券生效时间,时间戳
     */
    protected int $effTime;


    /**
     * @var string 优惠方式:00 满减；01 折扣;02 数量兑换
     */
    protected string $favbType;

    /**
     * @var int 折扣（0-100）：9.7 折存 97
     */
    protected int $discount;

    /**
     * @var string 使用开始时间
     */
    protected string $useBeginTime;

    /**
     * @var string 使用结束时间
     */
    protected string $useEndTime;

    /**
     * @var string 微信卡券 Id
     */
    protected string $wxCardId;

    /**
     * @var string 使用星期限制
     */
    protected string $weekLimit;

    /**
     * @var int 抵扣商品数量
     */
    protected int $disNum;

    /**
     * @var string 抵扣商品数量
     */
    protected string $couponMsgDes;

    /**
     * @var string 商家券批次号
     */
    protected string $stockId;

    /**
     * @var string 是否限制门店 0 否,1 是
     */
    protected string $shopLimit;

    /**
     * @var string 是否限制商品 0否，1 是
     */
    protected string $goodsLimit;

    /**
     * @var int 更新时间,时间戳
     */
    protected int $updTime;

    /**
     * @var int 创建时间,时间戳
     */
    protected int $crtTime;

    public function __construct(array $data)
    {
        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }


    /**
     * @return string
     */
    public function getCouponId(): int
    {
        return $this->couponId;
    }

    /**
     * @return string
     */
    public function getMerchantCode(): string
    {
        return $this->merchantCode;
    }

    /**
     * @return string
     */
    public function getCouponName(): string
    {
        return $this->couponName;
    }

    /**
     * @return string
     */
    public function getCouponType(): string
    {
        return $this->couponType;
    }

    /**
     * @return string
     */
    public function getExpDay(): string
    {
        return $this->expDay;
    }

    /**
     * @return string
     */
    public function getCouponState(): string
    {
        return $this->couponState;
    }

    /**
     * @return int
     */
    public function getCouponFee(): int
    {
        return $this->couponFee;
    }

    /**
     * @return int
     */
    public function getCreatePer(): int
    {
        return $this->createPer;
    }

    /**
     * @return string
     */
    public function getShareState(): string
    {
        return $this->shareState;
    }

    /**
     * @return string
     */
    public function getValidType(): string
    {
        return $this->validType;
    }

    /**
     * @return string
     */
    public function getEffTimeStr(): string
    {
        return $this->effTimeStr;
    }

    /**
     * @return string
     */
    public function getExpTimeStr(): string
    {
        return $this->expTimeStr;
    }

    /**
     * @return string
     */
    public function getUseLimitType(): string
    {
        return $this->useLimitType;
    }


    /**
     * @return string
     */
    public function getFavbType(): string
    {
        return $this->favbType;
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * @return string
     */
    public function getUseBeginTime(): string
    {
        return $this->useBeginTime;
    }

    /**
     * @return string
     */
    public function getUseEndTime(): string
    {
        return $this->useEndTime;
    }

    /**
     * @return string
     */
    public function getWxCardId(): string
    {
        return $this->wxCardId;
    }

    /**
     * @return string
     */
    public function getWeekLimit(): string
    {
        return $this->weekLimit;
    }

    /**
     * @return int
     */
    public function getDisNum(): int
    {
        return $this->disNum;
    }

    /**
     * @return string
     */
    public function getCouponMsgDes(): string
    {
        return $this->couponMsgDes;
    }

    /**
     * @return string
     */
    public function getStockIds(): string
    {
        return $this->stockId;
    }

    /**
     * @return string
     */
    public function getShopLimit(): string
    {
        return $this->shopLimit;
    }

    /**
     * @return string
     */
    public function getGoodsLimit(): string
    {
        return $this->goodsLimit;
    }

    /**
     * @return int
     */
    public function getEffTime(): int
    {
        return $this->effTime;
    }

    /**
     * @return int
     */
    public function getUpdTime(): int
    {
        return $this->updTime;
    }

    /**
     * @return int
     */
    public function getCrtTime(): int
    {
        return $this->crtTime;
    }
}