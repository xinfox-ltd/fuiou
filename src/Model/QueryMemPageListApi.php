<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;


class QueryMemPageListApi
{

    /**
     * @var string  手机号
     */
    private string $phone;

    /**
     * @var string  线下实体卡号
     */
    private string $offlineCardNo;

    /**
     * @var string  用户可用积分
     */
    private string $point;

    /**
     * @var string  用户 OpenId
     */
    private string $openId;


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
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getOfflineCardNo(): string
    {
        return $this->offlineCardNo;
    }

    /**
     * @return string
     */
    public function getPoint(): string
    {
        return $this->point;
    }

    /**
     * @return string
     */
    public function getOpenId()
    {
        return $this->openId;
    }


}