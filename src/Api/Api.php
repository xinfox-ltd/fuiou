<?php


namespace XinFox\Fuiou\Api;


use GuzzleHttp\Client;
use XinFox\Fuiou\Exceptions\ApiException;

abstract class Api
{
    protected Client $client;
    protected array $config;
    //测试：
//https://spht-test.fuioupay.com/api/queryBalance.action
//生产：
//https://sp-ht.fuioupay.com/api/queryBalance.action
    protected string $uri = "https://sp-ht.fuioupay.com/api/";  //crm接口连接

//测试：
//https://scantoeattest.fuiou.com/callBack/open.action
//正式：
//https://scte.fuioupay.com/callBack/open.action
    protected string $appletUrl = 'https://scte.fuioupay.com/callBack/open.action';//SaaS第三方小程序接口

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = new Client();

    }

    /**
     * 远程获取数据，POST模式
     * 注意：
     * @param string $url 指定URL完整路径地址
     * @param array $para 请求的数据
     * return 远程输出的数据
     * @return mixed
     */
    function getHttpResponseJSON(string $url, array $para)
    {
        $json = json_encode($para);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //信任任何证书
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json)
            )
        );
        $responseText = curl_exec($curl);
        curl_close($curl);
        return $responseText;
    }


    /**
     * 抛异常
     * @param $response
     * @throws ApiException
     */
    protected function throwApiException($response)
    {
        if (!isset($response['resultCode'])) {
            throw new ApiException('无数据返回');
        } elseif ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        }
    }

}