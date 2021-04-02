<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

/**
 * Class AddOrder
 * @package XinFox\Fuiou\Model
 */
class AddOrder
{

    /**
     * @var string
     */
    private string $status;

    /**
     * @var string
     */
    private string $msg;

    /**
     * @var  富友系统订单号
     */
    private $data;

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
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMsg(): string
    {
        return $this->msg;
    }


}