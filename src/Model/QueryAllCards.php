<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;


class QueryAllCards
{

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
    public function getCardId(): string
    {
        return $this->cardId;
    }

    /**
     * @return string
     */
    public function getCardName(): string
    {
        return $this->cardName;
    }
}