<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Fuiou;

use XinFox\Fuiou\Api\Crm;

/**
 * Class Fuiou
 * @property Crm $crm
 * @package XinFox\Fuiou
 */
class Fuiou
{
    public function crm()
    {
        return new Crm();
    }

    public function __get($name)
    {
        switch ($name) {
            case 'crm':
                return new Crm();
                break;
            default:
                throw new \InvalidArgumentException();
        }
    }
}