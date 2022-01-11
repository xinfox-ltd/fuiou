<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Api\Saas\Traits;

use XinFox\Fuiou\Exceptions\FuiouException;

trait SaasTrait
{
    /**
     * 请求参数
     *
     * @var array
     */
    private array $requestParams = [];

    /**
     * 公共调用接口函数
     * @param string $actionName 接口名称
     * @param array 参与签名的字段
     * @return array|mixed
     * @throws FuiouException
     */
    private function post(string $actionName, array $signArr = []): array
    {
        $params = $this->getRequestParams();
        foreach ($params as $key => $val) {
            if ($val === null) {
                unset($params[$key]);
            }
        }
        $params['key'] = $this->sign($signArr);
        $response = $this->curl($this->getApiHost() . $actionName . '.action', $params);

        $status = $response['respCode'] ?? null;
        $msg = $response['respDesc'] ?? null;
        if ($status != '000000') {
            throw new FuiouException($msg, (int)$status);
        }

        return $response;
    }

    /**
     * 签名
     *
     * @param array 数据数组
     * @param array 参与签名的字段
     * @return string
     */
    private function sign(array $signArr = []): string
    {
        $params = $this->getRequestParams();

        $sign = $this->getMchntCd() . '|' . $this->config['secret'];
        if (!empty($params) && !empty($signArr)) {
            foreach ($params as $key => $item) {
                if (in_array($key, $signArr)) {
                    $sign .= '|' . $item;
                }
            }
        }
        $sign .= '|' . $this->config['salt'];

        return md5($sign);
    }

    /**
     * 设置请求参数
     *
     * @param   [type]  $key    [$key description]
     * @param   [type]  $value  [$value description]
     *
     * @return  self      [return description]
     */
    public function setRequestParams($key, $value): self
    {
        $this->requestParams[$key] = $value;
        return $this;
    }

    /**
     * 获取请求参数
     *
     * @return array
     */
    public function getRequestParams(): array
    {
        return $this->requestParams;
    }

    /**
     * 检测参数是否设置
     *
     * @param   [type]  $key  [$key description]
     *
     * @return  Bool          [return description]
     */
    public function issetRequestParams($key): Bool
    {
        return (bool)isset($this->requestParams[$key]);
    }

    /**
     * 请求接口
     *
     * @return string
     */
    public function getApiHost(): string
    {
        return $this->test === false ? 'https://sp-ht.fuioupay.com/api/' : 'https://spht-test.fuioupay.com/api/';
    }
}
