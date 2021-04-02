<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

/**
 * Class OutSysShopBind
 * @package XinFox\Fuiou\Model
 */
class OutSysShopBind
{

    /**
     * @var string 富友系统订单号
     */
    private string $data;

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
    public function getData(): string
    {
        return $this->data;
    }

}