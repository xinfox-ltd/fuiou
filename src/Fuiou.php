<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox\Fuiou;

use XinFox\Fuiou\Api\Pay;
use XinFox\Fuiou\Api\Crm;
use XinFox\Fuiou\Api\Partner;
use XinFox\Fuiou\Api\Applet;
use XinFox\Fuiou\Api\Supply;
use XinFox\Fuiou\Exceptions\InvalidArgumentException;

/**
 * Class Fuiou
 * @property Crm $crm
 * @property Applet $applet
 * @package XinFox\Fuiou
 */
class Fuiou
{
    private array $config;

    private bool $test = false;

    /**
     * Fuiou constructor.
     * @param array $config
     * @throws InvalidArgumentException
     */
    public function __construct(array $config)
    {
        if (empty($config['mchnt_cd']) || empty($config['app_key']) || empty($config['secret'])) {
            throw new InvalidArgumentException('The mchnt_cd、app_key、secret must not be empty');
        }
        $this->config = $config;
    }

    /**
     * 启用测试环境
     * @return $this
     */
    public function test(): Fuiou
    {
        $this->test = true;
        return $this;
    }

    /**
     * @throws \XinFox\Fuiou\Exceptions\InvalidArgumentException
     */
    public function __get($name)
    {
        switch ($name) {
            case 'pay':
                return new Pay($this);
            case 'crm':
                return new Crm($this);
            case 'partner':
                return new Partner($this);
            case 'applet':
                return new Applet($this);
            case 'supply':
                return new Supply($this);
            default:
                throw new InvalidArgumentException();
        }
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function getTest(): bool
    {
        return $this->test;
    }
}