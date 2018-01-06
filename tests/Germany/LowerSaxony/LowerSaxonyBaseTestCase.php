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

namespace Yasumi\tests\Germany\LowerSaxony;

use Yasumi\tests\Germany\GermanyBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Lower Saxony (Germany) holiday provider.
 */
abstract class LowerSaxonyBaseTestCase extends GermanyBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'Germany/LowerSaxony';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Berlin';
}
