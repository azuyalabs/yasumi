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

namespace Yasumi\tests\Australia;

use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Australia holiday provider.
 */
abstract class AustraliaBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Locale that is considered common for this provider
     */
    const LOCALE = 'en_AU';
    /**
     * Name of the region (e.g. country / state) to be tested
     */
    public $region = 'Australia';
    /**
     * Timezone in which this provider has holidays defined
     */
    public $timezone = 'Australia/Melbourne';
}
