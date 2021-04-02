<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

/**
 * Class PushOrderDeliveryInfo
 * @package XinFox\Fuiou\Model
 */
class PushOrderDeliveryInfo
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