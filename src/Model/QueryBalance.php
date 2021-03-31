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
     * @var string
     */
    private string $cardId;

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
}