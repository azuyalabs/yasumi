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

namespace Yasumi\tests\Switzerland\Obwalden;

use Yasumi\tests\Switzerland\SwitzerlandBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Obwalden (Switzerland) holiday provider.
 */
abstract class ObwaldenBaseTestCase extends SwitzerlandBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    public const REGION = 'Switzerland/Obwalden';

    /**
     * Timezone in which this provider has holidays defined
     */
    public const TIMEZONE = 'Europe/Zurich';

    /**
     * Locale that is considered common for this provider
     */
    public const LOCALE = 'de_CH';
}
