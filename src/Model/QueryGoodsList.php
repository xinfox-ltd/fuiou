<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

/**
 * Class QueryGoodsList
 * @package XinFox\Fuiou\Model
 */
class QueryGoodsList
{

    /**
     * @var string 商品 ID
     */
    private string $goodsId;

    /**
     * @var string 商品名
     */
    private string $goodsName;

    /**
     * @var string 商品价格
     */
    private string $price;

    /**
     * @var string 商品折扣价格
     */
    private string $discountPrice;

    /**
     * @var string 会员价
     */
    private string $memberPrice;

    /**
     * @var string 商品分组 ID
     */
    private string $groupId;

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
    public function getGoodsId()
    {
        return $this->goodsId;
    }

    /**
     * @return string
     */
    public function getGoodsName()
    {
        return $this->goodsName;
    }

    /**
     * @return string
     */
    public function getPriced()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getDiscountPrice()
    {
        return $this->discountPrice;
    }

    /**
     * @return string
     */
    public function getMemberPrice()
    {
        return $this->memberPrice;
    }

    /**
     * @return string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

}