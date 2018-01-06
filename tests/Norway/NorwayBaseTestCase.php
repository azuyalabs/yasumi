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

namespace Yasumi\tests\Norway;

use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Norway holiday provider.
 */
abstract class NorwayBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'Norway';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Oslo';

    /**
     * Locale that is considered common for this provider
     */
    const LOCALE = 'nb_NO';
}
