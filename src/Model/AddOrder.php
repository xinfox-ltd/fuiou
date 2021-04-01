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


}