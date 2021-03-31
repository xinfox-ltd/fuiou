<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;


class QueryUserInfo
{
    /**
     * @var string  返回代码
     */
    private string $resultCode;

    /**
     * @var string 返回信息
     */
    private string $resultMsg;

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
    public function getResultCode()
    {
        return $this->resultCode;
    }

    /**
     * @return string
     */
    public function getResultMsg()
    {
        return $this->resultMsg;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @return string
     */
    public function getLevelValue()
    {
        return $this->levelValue;
    }

    /**
     * @return string
     */
    public function getOpenId()
    {
        return $this->openId;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getShoName()
    {
        return $this->shoName;
    }

    /**
     * @return string
     */
    public function getRegistTime()
    {
        return $this->registTime;
    }

    /**
     * @return int
     */
    public function getTotalConsumeAmt()
    {
        return $this->totalConsumeAmt;
    }

    /**
     * @return int
     */
    public function getTotalConsumeSum()
    {
        return $this->totalConsumeSum;
    }


}