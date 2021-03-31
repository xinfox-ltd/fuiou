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

    /**
     * @var string  返回代码
     */
    private string $resultCode;

    /**
     * @var string 返回信息
     */
    private string $resultMsg;

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
    public function getResultCode()
    {
        return $this->resultCode;
    }

    /**
     * @return string
     */
    public function getResultMsg()
    {
        return $this->resultMsg;
    }

    /**
     * @return mixed
     */
    public function getPoint()
    {
        return $this->point;
    }


}