<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Germany\MecklenburgWesternPomerania;

use Yasumi\tests\Germany\GermanyBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Mecklenburg-Western Pomerania (Germany) holiday provider.
 */
abstract class MecklenburgWesternPomeraniaBaseTestCase extends GermanyBaseTestCase
{
    use YasumiBase;

    /** Name of the region (e.g. country / state) to be tested. */
    public const REGION = 'Germany/MecklenburgWesternPomerania';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Europe/Berlin';
}
