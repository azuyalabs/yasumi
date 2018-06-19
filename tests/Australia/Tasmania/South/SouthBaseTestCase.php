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

namespace Yasumi\tests\Australia\Tasmania\South;

use Yasumi\tests\Australia\Tasmania\TasmaniaBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the northwestern Tasmania holiday provider.
 */
abstract class SouthBaseTestCase extends TasmaniaBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    public $region = 'Australia\Tasmania\South';

    /**
     * Timezone in which this provider has holidays defined
     */
    public $timezone = 'Australia/Tasmania';
}
