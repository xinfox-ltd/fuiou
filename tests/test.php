<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

require '../vendor/autoload.php';

$fuiou = new \XinFox\Fuiou\Fuiou(['']);
$fuiou->crm->queryBalance();

