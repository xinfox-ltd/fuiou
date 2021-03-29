<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Fuiou\Api;

use GuzzleHttp\Client;

class Crm extends Api
{
    protected $uri = "";

    public function queryBalance(string $cardId, string $openId): array
    {
        $response = $this->client->post();
        return json_decode($response->getBody()->getContents());
    }
}