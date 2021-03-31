<?php
/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

require '../vendor/autoload.php';

$config = [
    'mchntCd' => '0006110F3733501',
    'appKey' => '0006110F3733501',
    'secret' => '27e82212-be27-4e58-8cfa-e68c1dc2fd2b',
    'salt' => 'qlb6n7vUGo3W0J9ysHrxFTSF3R9h9Aqd',
    'host' => 'https://scte.fuioupay.com/callBack/open.action',
    'shop_id' => 62709
];

$fuiou = new \XinFox\Fuiou\Fuiou($config);
//addOrder
$str = '{
    "address":{
    "addres":"广西南宁市良庆区",
        "contacterName":"weixiaochao",
        "doorNum":"000",
        "gitu":"121.48161208",
        "mark":"jia",
        "phone":"15177175319",
        "titu":"31.67618799"
    },
    "channelType":"05",
    "deliverTm":"立即送达",
    "details":[
        {
            "attributes":[

        ],
            "goodsBasePrice":1,
            "goodsDisPrice":1,
            "goodsName":"无折扣菜品",
            "goodsNumber":1,
            "goodsPayAmt":1,
            "goodsPrice":1,
            "newSpecs":[

        ],
            "specExtraPrice":0
        }
    ],
    "expressAmt":1,
    "guestsCount":1,
    "mealCode":"1",
    "orderAmt":2,
    "orderDisAmt":1,
    "orderType":"02",
    "payAmt":2,
    "orderState":"02",
    "payType":"LETPAY",
    "shopId":22304,
    "thirdMchntIncome":2,
    "thirdPartyOrderNo":"3061005572529515547",
    "userMemo":""
}';

$content = json_decode($str, true);
$dddd = $fuiou->applet->pushOrderDeliveryInfo('70387ssssssss','1','','');
echo '<pre>';
print_r($dddd);
echo '</pre>';
exit();
