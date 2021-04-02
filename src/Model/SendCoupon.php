<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

/**
 * Class SendCoupon
 * @package XinFox\Fuiou\Model
 */
class SendCoupon
{
    /**
     * @var int 发放成功条数
     */
    private int $totolCount;

    /**
     * @var array 用户优惠券 ID 列表例：[id1,id2,id3......]
     */
    private array $userCouponIdList;

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
    public function getTotolCount(): int
    {
        return $this->totolCount;
    }

    /**
     * @return array
     */
    public function getUserCouponIdList(): array
    {
        return $this->userCouponIdList;
    }


}