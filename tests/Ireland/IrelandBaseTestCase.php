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

namespace Yasumi\tests\Ireland;

use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Ireland holiday provider.
 */
abstract class IrelandBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'Ireland';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Dublin';

    /**
     * Locale that is considered common for this provider
     */
    const LOCALE = 'en_IE';

    /**
     * Number of iterations to be used for the various unit test of this provider
     */
    const TEST_ITERATIONS = 50;
}
