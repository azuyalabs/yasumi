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

namespace Yasumi\tests\Australia\Queensland\Brisbane;

use Yasumi\tests\Australia\Queensland\QueenslandBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Queensland holiday provider.
 */
abstract class BrisbaneBaseTestCase extends QueenslandBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    public $region = 'Australia\Queensland\Brisbane';

    /**
     * Timezone in which this provider has holidays defined
     */
    public $timezone = 'Australia/Brisbane';
}
