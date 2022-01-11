<?php

namespace XinFox\Fuiou\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use XinFox\Fuiou\Exceptions\FuiouException;
use XinFox\Fuiou\Fuiou;

abstract class Api
{
    protected Client $client;

    protected array $config;

    protected bool $test;

    /**
     * @var Fuiou
     */
    protected Fuiou $app;

    public function __construct(Fuiou $app)
    {
        $this->app = $app;
        $this->config = $app->getConfig();
        $this->client = new Client();
        $this->test = $app->getTest();
    }

    protected function getMchntCd(): string
    {
        return $this->config['mchnt_cd'];
    }

    /**
     * 远程获取数据，POST模式
     * 注意：
     * @param string $url 指定URL完整路径地址
     * @param array $data 请求的数据
     * return 远程输出的数据
     * @return mixed
     * @throws \XinFox\Fuiou\Exceptions\FuiouException
     */
    function curl(string $url, array $data)
    {
        $client = new Client(['verify' => false]);
        try {
            $response = $client->post($url, ['json' => $data]);
        } catch (GuzzleException $exception) {
            throw new FuiouException('网络异常-' . $exception->getMessage());
        }
        $bodyContent = $response->getBody()->getContents();

        if (empty($bodyContent)) {
            throw new FuiouException('接口返回空');
        }

        return json_decode($bodyContent, true);
    }
}
