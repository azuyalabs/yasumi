<?php

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Latvia;

use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Latvia holiday provider.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
abstract class LatviaBaseTestCase extends \PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Name of the country to be tested
     */
    const REGION = 'Latvia';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Riga';

    /**
     * Locale that is considered common for this provider
     */
    const LOCALE = 'lv_LV';
}
