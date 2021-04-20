<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Fuiou\Model;

use XinFox\Fuiou\Model;

class ShopTable extends Model
{
    /**
     * @return int
     */
    public function getSeatNum(): int
    {
        return $this->data['seatNum'];
    }

    /**
     * @return string
     */
    public function getAreaName(): string
    {
        return $this->data['areaName'];
    }

    /**
     * @return int
     */
    public function getTableState(): int
    {
        return $this->data['tableState'];
    }

    /**
     * @return int
     */
    public function getStableId(): int
    {
        return $this->data['stableId'];
    }
}