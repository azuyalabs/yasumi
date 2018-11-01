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

namespace Yasumi\tests\Lithuania;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Lithuania holiday provider.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
abstract class LithuaniaBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Name of the country to be tested
     */
    const REGION = 'Lithuania';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Vilnius';

    /**
     * Locale that is considered common for this provider
     */
    const LOCALE = 'lt_LT';
}
