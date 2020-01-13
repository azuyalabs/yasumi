<?php declare(strict_types=1);

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\SouthAfrica;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the South Africa holiday provider.
 *
 * @package Yasumi\tests\SouthAfrica
 * @author  Sacha Telgenhof <sme@sachatelgenhof.com>
 */
abstract class SouthAfricaBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    public const REGION = 'SouthAfrica';

    /**
     * Timezone in which this provider has holidays defined
     */
    public const TIMEZONE = 'Africa/Johannesburg';

    /**
     * Locale that is considered common for this provider
     */
    public const LOCALE = 'en_ZA';
}
