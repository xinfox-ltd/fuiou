<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

/**
 * Class EditPoint
 * @package XinFox\Fuiou\Model
 */
class EditPoint
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
     * @return mixed
     */
    public function getPoint()
    {
        return $this->point;
    }


}