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

namespace Yasumi\tests\Spain\CanaryIslands;

use Yasumi\tests\Spain\SpainBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Canary Islands (Spain) holiday provider.
 */
abstract class CanaryIslandsBaseTestCase extends SpainBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'Spain/CanaryIslands';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Atlantic/Canary';
}
