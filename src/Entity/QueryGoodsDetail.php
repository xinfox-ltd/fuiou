<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Entity;

/**
 * Class QueryGoodsDetail
 * @package XinFox\Fuiou\Entity
 */
class QueryGoodsDetail
{
    const CHANNEL_APPLET = '00'; // 扫码点餐（小程序）
    const CHANNEL_POS = '01'; // 扫码点餐（小程序）

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

    /**
     * @var array 属性列表
     */
    private array $goodsSpecList;

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
    public function getGoodsId(): string
    {
        return $this->goodsId;
    }

    /**
     * @return string
     */
    public function getGoodsName(): string
    {
        return $this->goodsName;
    }

    /**
     * @return string
     */
    public function getPriced(): string
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getDiscountPrice(): string
    {
        return $this->discountPrice;
    }

    /**
     * @return string
     */
    public function getMemberPrice(): string
    {
        return $this->memberPrice;
    }

    /**
     * @return string
     */
    public function getGroupId(): string
    {
        return $this->groupId;
    }

    /**
     * @return array
     */
    public function getGoodsSpecList(): array
    {
        return $this->goodsSpecList;
    }
}