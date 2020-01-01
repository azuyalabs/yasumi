<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Austria\LowerAustria;

use Yasumi\tests\Austria\AustriaBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Lower Austria (Austria) holiday provider.
 */
abstract class LowerAustriaBaseTestCase extends AustriaBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested.
     */
    public const REGION = 'Austria/LowerAustria';
}
