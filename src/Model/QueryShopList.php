<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

/**
 * Class QueryShopList
 * @package XinFox\Fuiou\Model
 */
class QueryShopList
{

    /**
     * @var string 门店 ID
     */
    private string $shopId;

    /**
     * @var string 门店名
     */
    private string $shopName;

    /**
     * @var string 门店地址
     */
    private string $shopAddress;

    /**
     * @var string 门店联系电话
     */
    private string $shopPhone;

    /**
     * @var string 营业开始时间
     */
    private string $openHoursBegin;

    /**
     * @var string 营业结束时间
     */
    private string $openHoursEnd;

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
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @return string
     */
    public function getShopName()
    {
        return $this->shopName;
    }

    /**
     * @return string
     */
    public function getShopAddress()
    {
        return $this->shopAddress;
    }

    /**
     * @return string
     */
    public function getShopPhone()
    {
        return $this->shopPhone;
    }

    /**
     * @return string
     */
    public function getOpenHoursBegin()
    {
        return $this->openHoursBegin;
    }

    /**
     * @return string
     */
    public function getOpenHoursEnd()
    {
        return $this->openHoursEnd;
    }

}