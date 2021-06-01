<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Entity;

use XinFox\Fuiou\Exceptions\FuiouException;
use XinFox\Fuiou\Exceptions\InvalidArgumentException;
use XinFox\Fuiou\Fuiou;
use XinFox\Fuiou\Entity;

/**
 * Class User
 * @package XinFox\Fuiou\Entity
 */
class User extends Entity
{
    /**
     * @var string 昵称
     */
    protected string $userName;

    /**
     * @var int 经验值
     */
    protected int $experience;

    /**
     * @var int 等级
     */
    protected int $levelValue;

    /**
     * @var string 微信 openId
     */
    protected string $openId;

    /**
     * @var string 性别：1 男性，2 女性，0 未知
     */
    protected string $sex;

    /**
     * @var string 生日
     */
    protected string $birthday;

    /**
     * @var string 国家
     */
    protected string $country;

    /**
     * @var string 省份
     */
    protected string $province;

    /**
     * @var string 城市
     */
    protected string $city;

    /**
     * @var string 会员发展门店
     */
    protected string $shoName;

    /**
     * @var string 注册时间
     */
    protected string $registTime;

    /**
     * @var int 消费总金额（分）
     */
    protected int $totalConsumeAmt;

    /**
     * @var int 消费总笔数
     */
    protected int $totalConsumeSum;

    protected Fuiou $app;

    /**
     * @param int $couponId
     * @return array
     * @throws FuiouException
     */
    public function sendCoupon(int $couponId): array
    {
        return $this->app->crm->sendCouponToOpenId($couponId, [$this->openId]);
    }

    /**
     * @param string $couponState
     * @param string $useState
     * @param string $sortType
     * @return array
     * @throws FuiouException
     * @throws InvalidArgumentException
     */
    public function coupons(
        string $couponState = '',
        string $useState = '',
        string $sortType = UserCoupon::SORT_EXPIRE_TIME_DESC
    ): array {
        return $this->app->crm->queryUserCouponsByOpenId($this->openId, $couponState, $useState, $sortType);
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @return int
     */
    public function getExperience(): int
    {
        return $this->experience;
    }

    /**
     * @return int
     */
    public function getLevelValue(): int
    {
        return $this->levelValue;
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
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getShoName(): string
    {
        return $this->shoName;
    }

    /**
     * @return string
     */
    public function getRegistTime(): string
    {
        return $this->registTime;
    }

    /**
     * @return int
     */
    public function getTotalConsumeAmt(): int
    {
        return $this->totalConsumeAmt;
    }

    /**
     * @return int
     */
    public function getTotalConsumeSum(): int
    {
        return $this->totalConsumeSum;
    }
}