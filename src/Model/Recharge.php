<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;


class Recharge
{

    /**
     * @var int  余额（分）
     */
    private int $balance;

    /**
     * @var int 主账户余额（分）
     */
    private int $trdBalance;

    /**
     * @var int 赠送账户余额（分）
     */
    private int $giveBalance;


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
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @return int
     */
    public function getTrdBalance(): int
    {
        return $this->trdBalance;
    }

    /**
     * @return int
     */
    public function getGiveBalance(): int
    {
        return $this->giveBalance;
    }


}