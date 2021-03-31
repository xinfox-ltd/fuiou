<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

/**
 * Class Adjust
 * @package XinFox\Fuiou\Model
 */
class Adjust
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

    /**
     * @var string  返回代码
     */
    private string $resultCode;

    /**
     * @var string 返回信息
     */
    private string $resultMsg;

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

}