<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */
namespace Yasumi\Tests\Japan;

use PHPUnit_Framework_TestCase;
use Yasumi\Tests\YasumiBase;

/**
 * Class JapanBaseTestCase.
 */
abstract class JapanBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested
     */
    const COUNTRY = 'Japan';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Asia/Tokyo';
}
