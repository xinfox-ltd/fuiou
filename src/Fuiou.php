<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Fuiou;

use XinFox\Fuiou\Api\Applet;
use XinFox\Fuiou\Api\Crm;
use XinFox\Fuiou\Exceptions\InvalidArgumentException;

/**
 * Class Fuiou
 * @property Crm $crm
 * @property Applet $applet
 * @package XinFox\Fuiou
 */
class Fuiou
{
    public array $config;

    /**
     * Fuiou constructor.
     * @param array $config
     * @throws InvalidArgumentException
     */
    public function __construct(array $config)
    {
        if (!empty($config)) {
            if (empty($config['mchntCd']) || empty($config['appKey']) || empty($config['secret'])) {
                throw new InvalidArgumentException('The mchntCd、appKey、secret must not be empty');
            }
            $this->config = $config;

        } else {

            throw new InvalidArgumentException();
        }

    }

    public function __get($name)
    {
        switch ($name) {
            case 'crm':
                return new Crm($this->config);
                break;
            case 'applet':
                return new Applet($this->config);
                break;
            default:
                throw new \InvalidArgumentException();
        }
    }
}