<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Colombia;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for Colombia holiday tests.
 */
abstract class ColombiaBaseTestCase extends TestCase
{
    use YasumiBase;

    /** Country (name) to be tested. */
    public const REGION = 'Colombia';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'America/Bogota';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'es';
}
