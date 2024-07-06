<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Iran;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

class IranBaseTestCase extends TestCase
{
    use YasumiBase;

    public const REGION = 'Iran';

    public const TIMEZONE = 'Asia/Tehran';

    public const LOCALE = 'fa';
}
