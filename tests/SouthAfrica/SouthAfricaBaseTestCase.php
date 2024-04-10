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

namespace Yasumi\tests\SouthAfrica;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the South Africa holiday provider.
 *
 * @author  Sacha Telgenhof <sme at sachatelgenhof dot com>
 */
abstract class SouthAfricaBaseTestCase extends TestCase
{
    use YasumiBase;

    /** Name of the region (e.g. country / state) to be tested. */
    public const REGION = 'SouthAfrica';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Africa/Johannesburg';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'en_ZA';
}
