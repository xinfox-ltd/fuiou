<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;


class QueryMchntCouponListPage
{
    /**
     * @var int 优惠券模板 ID
     */
    private Int $couponId;

    /**
     * @var string 商户号
     */
    private string $merchantCode;

    /**
     * @var string 优惠券名称
     */
    private string $couponName;

    /**
     * @var string 优惠券类型：00：系统内置优惠券，01：用户创建优惠券，04：微信卡券，05：微信商家券
     */
    private string $couponType;

    /**
     * @var string 有效天数
     */
    private string $expDay;

    /**
     * @var string 优惠券状态, 00:正常,01:过期,02:作废,03:未生效,04:已转赠
     */
    private string $couponState;

    /**
     * @var int 优惠金额 以分为单位
     */
    private int $couponFee;

    /**
     * @var int 优惠方式:满减金额，eg:满 100 减 5，此字段则为 10000 以分为单位
     */
    private int $createPer;

    /**
     * @var string 分享状态：00：不能分享，01：允许分享
     */
    private string $shareState;

    /**
     * @var string 有效方式：00：领券即生效，01：固定起止时间
     */
    private string $validType;

    /**
     * @var string 优惠券生效时间
     */
    private string $effTimeStr;

    /**
     * @var string 优惠券失效时间
     */
    private string $expTimeStr;

    /**
     * @var string 使用限制：00：无限制， 01 ： 收 银机 ， 02 ： 外 卖 ，03：小程序堂食
     */
    private string $useLimitType;

    /**
     * @var int 优惠券生效时间,时间戳
     */
    private int $effTime;


    /**
     * @var string 优惠方式:00 满减；01 折扣;02 数量兑换
     */
    private string $favbType;

    /**
     * @var int 折扣（0-100）：9.7 折存 97
     */
    private int $discount;

    /**
     * @var string 使用开始时间
     */
    private string $useBeginTime;

    /**
     * @var string 使用结束时间
     */
    private string $useEndTime;

    /**
     * @var string 微信卡券 Id
     */
    private string $wxCardId;

    /**
     * @var string 使用星期限制
     */
    private string $weekLimit;

    /**
     * @var int 抵扣商品数量
     */
    private int $disNum;

    /**
     * @var string 抵扣商品数量
     */
    private string $couponMsgDes;

    /**
     * @var string 商家券批次号
     */
    private string $stockId;

    /**
     * @var string 是否限制门店 0 否,1 是
     */
    private string $shopLimit;

    /**
     * @var string 是否限制商品 0否，1 是
     */
    private string $goodsLimit;

    /**
     * @var int 更新时间,时间戳
     */
    private int $updTime;

    /**
     * @var int 创建时间,时间戳
     */
    private int $crtTime;

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
    public function getCouponId()
    {
        return $this->couponId;
    }

    /**
     * @return string
     */
    public function getMerchantCode()
    {
        return $this->merchantCode;
    }

    /**
     * @return string
     */
    public function getCouponName()
    {
        return $this->couponName;
    }

    /**
     * @return string
     */
    public function getCouponType()
    {
        return $this->couponType;
    }

    /**
     * @return string
     */
    public function getExpDay()
    {
        return $this->expDay;
    }

    /**
     * @return string
     */
    public function getCouponState()
    {
        return $this->couponState;
    }

    /**
     * @return string
     */
    public function getCouponFee()
    {
        return $this->couponFee;
    }

    /**
     * @return string
     */
    public function getCreatePer()
    {
        return $this->createPer;
    }

    /**
     * @return string
     */
    public function getShareState()
    {
        return $this->shareState;
    }

    /**
     * @return string
     */
    public function getValidType()
    {
        return $this->validType;
    }

    /**
     * @return string
     */
    public function getEffTimeStr()
    {
        return $this->effTimeStr;
    }

    /**
     * @return string
     */
    public function getExpTimeStr()
    {
        return $this->expTimeStr;
    }

    /**
     * @return string
     */
    public function getUseLimitType()
    {
        return $this->useLimitType;
    }


    /**
     * @return string
     */
    public function getFavbType()
    {
        return $this->favbType;
    }

    /**
     * @return string
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @return string
     */
    public function getUseBeginTime()
    {
        return $this->useBeginTime;
    }

    /**
     * @return string
     */
    public function getUseEndTime()
    {
        return $this->useEndTime;
    }

    /**
     * @return string
     */
    public function getWxCardId()
    {
        return $this->wxCardId;
    }

    /**
     * @return string
     */
    public function getWeekLimit()
    {
        return $this->weekLimit;
    }

    /**
     * @return int
     */
    public function getDisNum()
    {
        return $this->disNum;
    }

    /**
     * @return string
     */
    public function getCouponMsgDes()
    {
        return $this->couponMsgDes;
    }

    /**
     * @return string
     */
    public function getStockIds()
    {
        return $this->stockId;
    }

    /**
     * @return string
     */
    public function getShopLimit()
    {
        return $this->shopLimit;
    }

    /**
     * @return string
     */
    public function getGoodsLimit()
    {
        return $this->goodsLimit;
    }

    /**
     * @return string
     */
    public function getEffTime()
    {
        return $this->effTime;
    }

    /**
     * @return int
     */
    public function getUpdTime()
    {
        return $this->updTime;
    }

    /**
     * @return int
     */
    public function getCrtTime()
    {
        return $this->crtTime;
    }
}