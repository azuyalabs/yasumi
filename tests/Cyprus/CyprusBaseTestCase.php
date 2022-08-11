<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 * @author Bertrand Kintanar <bertrand dot kintanar at gmail dot com>
 */

namespace Yasumi\tests\Cyprus;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Cyprus holiday provider.
 *
 * Class CzechRepublicBaseTestCase
 *
 * @author  Bertrand Kintanar <bertrand dot kintanar at gmail dot com>
 */
abstract class CyprusBaseTestCase extends TestCase
{
    use YasumiBase;

    /** Name of the region (e.g. country / state) to be tested. */
    public const REGION = 'Cyprus';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Asia/Nicosia';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'en_CY';
}
