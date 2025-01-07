<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

$config = new AzuyaLabs\PhpCsFixerConfig\Config('2015', null, 'Yasumi');
$config->getFinder()->in(__DIR__)->notPath('var');

$defaults = $config->getRules();

$config->setRules(array_merge($defaults, [
    'php_unit_method_casing' => ['case' => 'camel_case'],
]));

return $config;
