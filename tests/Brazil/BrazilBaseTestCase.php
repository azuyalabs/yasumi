<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Dorian Neto <doriansampaioneto@gmail.com>
 */

namespace Yasumi\Tests\Brazil;

use PHPUnit_Framework_TestCase;
use Yasumi\Tests\YasumiBase;

/**
 * Class BrazilBaseTestCase.
 */
abstract class BrazilBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested
     */
    const REGION = 'Brazil';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'America/Fortaleza';
}
