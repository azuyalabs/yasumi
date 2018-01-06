<?php

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\SouthAfrica;

use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the South Africa holiday provider.
 *
 * @package Yasumi\tests\SouthAfrica
 * @author  Sacha Telgenhof <stelgenhof@gmail.com>
 */
abstract class SouthAfricaBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'SouthAfrica';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Africa/Johannesburg';

    /**
     * Locale that is considered common for this provider
     */
    const LOCALE = 'en_ZA';
}
