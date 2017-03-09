<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Aron Novak <aron@gizra.com>
 */

namespace Yasumi\tests\Hungary;

use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Hungary holiday provider.
 */
abstract class HungaryBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'Hungary';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Budapest';

    /**
     * Locale that is considered common for this provider
     */
    const LOCALE = 'hu_HU';
}
