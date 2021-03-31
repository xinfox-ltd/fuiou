<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;


class QueryAllCards
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
     * @var string 卡 id
     */
    private string $cardId;

    /**
     * @var string 卡名称
     */
    private string $cardName;


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
    public function getCardId()
    {
        return $this->cardId;
    }

    /**
     * @return string
     */
    public function getCardName()
    {
        return $this->cardName;
    }
}