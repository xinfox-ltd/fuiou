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
     * @var string  返回码：0000 成功；其余失败
     */
    private string $status;

    /**
     * @var string 返回信息描述
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }


}