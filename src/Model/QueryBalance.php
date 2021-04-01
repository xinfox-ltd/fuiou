<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

/**
 * Class QueryBalance
 * @package XinFox\Fuiou\Model
 */
class QueryBalance
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
    public function getBalance()
    {
        return $this->balance;
    }
    

    /**
     * @return int
     */
    public function getTrdBalance()
    {
        return $this->trdBalance;
    }

    /**
     * @return int
     */
    public function getGiveBalance()
    {
        return $this->giveBalance;
    }
    
}