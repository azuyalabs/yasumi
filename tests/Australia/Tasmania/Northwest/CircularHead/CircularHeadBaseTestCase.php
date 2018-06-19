<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author William Sanders <williamrsanders@hotmail.com>
 */

namespace Yasumi\tests\Australia\Tasmania\Northwest\CircularHead;

use Yasumi\tests\Australia\Tasmania\Northwest\NorthwestBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the northwestern Tasmania holiday provider.
 */
abstract class CircularHeadBaseTestCase extends NorthwestBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    public $region = 'Australia\Tasmania\Northwest\CircularHead';

    /**
     * Timezone in which this provider has holidays defined
     */
    public $timezone = 'Australia/Tasmania';
}
