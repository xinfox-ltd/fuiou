<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;


class QueryPoint
{
    /**
     * @var 9位内数字
     */
    private int $point;

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
    public function getPoint(): int
    {
        return $this->point;
    }

}