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

namespace Yasumi\tests\Greece;

use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Greece holiday provider.
 */
abstract class GreeceBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested
     */
    const REGION = 'Greece';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Athens';

    /**
     * Locale that is considered common for this provider
     */
    const LOCALE = 'el_GR';
}
