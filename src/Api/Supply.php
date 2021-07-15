<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Api;

use XinFox\Fuiou\Exceptions\FuiouException;

/**
 * 上海富有支付--供应链接口
 * Class Applet
 * @package XinFox\Fuiou\Api
 */
class Supply extends Api
{

    /**
     * 获取分组列表 -- 商品分类
     *
     * @param   string  $relateInsCd  代理商机构号(使用机构密 钥时填写)
     *
     * @return  array                 [return description]
     */
    public function queryTypeList(string $relateInsCd = ''): array
    {
        return $this->request(
            '/api/queryTypeList.action',
            [
                'relateInsCd' => $relateInsCd
            ],
            [$this->config['secret']]
        );
    }

    /**
     * @param string $action
     * @param array $params
     * @param mixed $signParams
     * @return array
     * @throws FuiouException
     */
    protected function request(string $action, array $params = [], $signParams = []): array
    {
        $params['mchntCd'] = $this->getMchntCd();
        if (is_array($signParams)) {
            $params['key'] = $this->sign1($signParams);
        } else {
            $params['key'] = $signParams;
        }

        $response = $this->curl($this->getApiHost() . $action, $params);
        if (empty($response)) {
            throw new FuiouException('无数据返回');
        }

        $responseCode = $response['resultCode'] ?? $response['respCode'];
        if (!$responseCode) {
            throw new FuiouException('无数据返回');
        } elseif ($responseCode != '000000') {
            throw new FuiouException($response['resultMsg'] ?? $response['respDesc'], (int)$responseCode);
        }

        return $response;
    }

    /**
     * 签名方式1
     * @param array $array
     * @return string
     */
    protected function sign1(array $array = []): string
    {
        array_unshift($array, $this->config['mchnt_cd']);
        array_push($array, $this->config['salt']);
        return $this->sign($array);
    }

    /**
     * 签名方式2
     * @param mixed $phone
     * @return string
     */
    protected function sign2($phone = ''): string
    {
        $array = [
            $phone,
            $this->getMchntCd(),
            $this->config['salt']
        ];

        return $this->sign($array);
    }

    /**
     * 签名
     * @param array $signArray
     * @return string
     */
    private function sign(array $signArray): string
    {
        $signString = implode('|', $signArray);
        return md5($signString);
    }

    private function getApiHost(): string
    {
        return $this->test === false ? 'https://sp-ht.fuioupay.com' : 'https://spht-test.fuioupay.com';
    }
}
