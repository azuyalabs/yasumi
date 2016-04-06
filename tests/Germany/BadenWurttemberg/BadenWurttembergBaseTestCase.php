<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Tests\Germany\BadenWurttemberg;

use Yasumi\Tests\Germany\GermanyBaseTestCase;
use Yasumi\Tests\YasumiBase;

/**
 * Base class for test cases of the Baden-Württemberg (Germany) holiday provider.
 */
abstract class BadenWurttembergBaseTestCase extends GermanyBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'Germany/BadenWurttemberg';
}
