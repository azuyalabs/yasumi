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

namespace Yasumi\tests\Germany\MecklenburgWesternPomerania;

use Yasumi\tests\Germany\GermanyBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Mecklenburg-Western Pomerania (Germany) holiday provider.
 */
abstract class MecklenburgWesternPomeraniaBaseTestCase extends GermanyBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'Germany/MecklenburgWesternPomerania';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Berlin';
}
