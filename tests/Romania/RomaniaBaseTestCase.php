<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2017 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Romania;

use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Class RomaniaBaseTestCase
 * @package Yasumi\tests\Romania
 */
class RomaniaBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'Romania';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Bucharest';

    /**
     * Locale that is considered common for this provider
     */
    const LOCALE = 'ro_RO';
}
