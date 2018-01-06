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

namespace Yasumi\tests\Japan;

use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Class JapanBaseTestCase.
 */
abstract class JapanBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested
     */
    const REGION = 'Japan';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Asia/Tokyo';

    /**
     * Prefix for short name used when holiday is substituted
     */
    const SUBSTITUTE_PREFIX = 'substituteHoliday:';

    /**
     * Locale that is considered common for this provider
     */
    const LOCALE = 'ja_JP';
}
