<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

use XinFox\Fuiou\Exceptions\ApiException;
use XinFox\Fuiou\Fuiou;

/**
 * Class User
 * @package XinFox\Fuiou\Model
 */
class User
{
    /**
     * @var string 昵称
     */
    private string $userName;

    /**
     * @var int 经验值
     */
    private int $experience;

    /**
     * @var int 等级
     */
    private int $levelValue;

    /**
     * @var string 微信 openId
     */
    private string $openId;

    /**
     * @var string 性别：1 男性，2 女性，0 未知
     */
    private string $sex;

    /**
     * @var string 生日
     */
    private string $birthday;

    /**
     * @var string 国家
     */
    private string $country;

    /**
     * @var string 省份
     */
    private string $province;

    /**
     * @var string 城市
     */
    private string $city;

    /**
     * @var string 会员发展门店
     */
    private string $shoName;

    /**
     * @var string 注册时间
     */
    private string $registTime;

    /**
     * @var int 消费总金额（分）
     */
    private int $totalConsumeAmt;

    /**
     * @var int 消费总笔数
     */
    private int $totalConsumeSum;


    private Fuiou $app;


    public function __construct(Fuiou $app, array $data)
    {
        $this->app = $app;
        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * @param int $couponId
     * @return array
     * @throws ApiException
     */
    public function sendCoupon(int $couponId): array
    {
        return $this->app->crm->sendCouponToOpenId($couponId, [$this->openId]);
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