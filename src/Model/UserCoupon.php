<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

use XinFox\Fuiou\Model;

class UserCoupon extends Model
{
    const STATE_NORMAL = '00'; //正常
    const STATE_EXPIRE = '01'; // 过期,
    const STATE_DISCARD = '02'; //作废
    const STATE_INVALID = '03'; //未生效
    const STATE_GIVE = '04'; // 已转赠

    const USE_STATE_UNUSED = '00'; // 未使用
    const USE_STATE_USED = '01'; // 已使用
    const USE_STATE_FREEZE = '02'; // 冻结中

    const SORT_EXPIRE_TIME_DESC = '00'; // 根据过期时间倒序
    const SORT_CREATE_TIME_DESC = '01'; // 根据新增时间倒序

    /**
     * @var int 用户优惠券 ID
     */
    private int $userCouponId;

    /**
     * @var string 用户 openId
     */
    private string $openId;

    /**
     * @var string 商户代码
     */
    private string $mchntCd;

    /**
     * @var int 优惠券模板 ID
     */
    private Int $couponId;

    /**
     * @var string 优惠券状态, 00:正常,01:过期,02:作废,03:未生效,04:已转赠
     */
    private string $couponState;

    /**
     * @var string 优惠券名称
     */
    private string $couponName;

    /**
     * @var string 优惠券类型：00：系统内置优惠券，01：用户创建优惠券，04：微信卡券，05：微信商家券
     */
    private string $couponType;

    /**
     * @var string 优惠方式:00 满减；01 折扣;02 数量兑换
     */
    private string $favbType;

    /**
     * @var int 优惠方式:满减金额，eg:满 100 减 5，此字段则为 10000 以分为单位
     */
    private int $createPer;

    /**
     * @var int 优惠金额 以分为单位
     */
    private int $couponFee;

    /**
     * @var int 折扣（0-100）：9.7 折存 97
     */
    private int $discount;

    /**
     * @var int 折扣（0-100）：9.7 折存 97
     */
    private int $disNum;

    /**
     * @var string 兑换券信息
     */
    private string $couponMsgDes;

    /**
     * @var int 创建时间,时间戳
     */
    private int $crtTime;

    /**
     * @var string 创建时间 , 格 式 yyyy-MM-dd HH:mm:ss
     */
    private string $crtTimeStr;

    /**
     * @var int 更新时间,时间戳
     */
    private int $updTime;

    /**
     * @var int 优惠券生效时间,时间戳
     */
    private int $effTime;

    /**
     * @var string 优惠券生效时间，格式 yyyyMM-dd
     */
    private string $effTimeStr;

    /**
     * @var int 优惠券过期时间,时间戳
     */
    private int $expTime;

    /**
     * @var string 优惠券过期时间
     */
    private string $expTimeStr;

    /**
     * @var string 使用限制：00：无限制，01：收银机，02：外卖，03：小程序堂食 默认：00（01，02，03 也为无限制 可拼接）
     */
    private string $useLimitType;

    /**
     * @var string 使用星期限制 0,1,2,3,4,5,6 0 对应星期天，1对应星期一
     */
    private string $weekLimit;

    /**
     * @var string 使用开始时间
     */
    private string $useBeginTime;

    /**
     * @var string 使用结束时间
     */
    private string $useEndTime;

    /**
     * @var string 使用订单号
     */
    private string $orderNo;

    /**
     * @var string 发券时当前时间，格式 yyyyMM-dd
     */
    private string $curDate;

    /**
     * @var int 使用用时的订单金额 以分为单位
     */
    private int $orderAmt;

    /**
     * @var string 微信卡券编号：当 couponType为 04、05 时不为空
     */
    private string $wxUserCardCode;

    /**
     * @var string 受赠人 openId
     */
    private string $receiveOpenId;

    /**
     * @var string 受赠人昵称
     */
    private string $receiveUserName;

    public function __construct(array $data)
    {
        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * @return int
     */
    public function getUserCouponId(): int
    {
        return $this->userCouponId;
    }

    /**
     * @return string
     */
    public function getOpenId(): string
    {
        return $this->openId;
    }

    /**
     * @return string
     */
    public function getMchntCd(): string
    {
        return $this->mchntCd;
    }

    /**
     * @return int
     */
    public function getCouponId(): int
    {
        return $this->couponId;
    }

    /**
     * @return string
     */
    public function getCouponState(): string
    {
        return $this->couponState;
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
    public function getFavbType(): string
    {
        return $this->favbType;
    }

    /**
     * @return int
     */
    public function getCreatePer(): int
    {
        return $this->createPer;
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
    public function getDiscount(): int
    {
        return $this->discount;
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
     * @return int
     */
    public function getCrtTime(): int
    {
        return $this->crtTime;
    }

    /**
     * @return string
     */
    public function getCrtTimeStr(): string
    {
        return $this->crtTimeStr;
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
    public function getEffTime(): int
    {
        return $this->effTime;
    }

    /**
     * @return string
     */
    public function getEffTimeStr(): string
    {
        return $this->effTimeStr;
    }

    /**
     * @return int
     */
    public function getExpTime(): int
    {
        return $this->expTime;
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
    public function getWeekLimit(): string
    {
        return $this->weekLimit;
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
    public function getOrderNo(): string
    {
        return $this->orderNo;
    }

    /**
     * @return string
     */
    public function getCurDate(): string
    {
        return $this->curDate;
    }

    /**
     * @return int
     */
    public function getOrderAmt(): int
    {
        return $this->orderAmt;
    }

    /**
     * @return string
     */
    public function getWxUserCardCode(): string
    {
        return $this->wxUserCardCode;
    }

    /**
     * @return string
     */
    public function getReceiveOpenId(): string
    {
        return $this->receiveOpenId;
    }

    /**
     * @return string
     */
    public function getReceiveUserName(): string
    {
        return $this->receiveUserName;
    }


}