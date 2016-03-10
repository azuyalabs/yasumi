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
namespace Yasumi\Tests\Spain\Melilla;

use Yasumi\Tests\Spain\SpainBaseTestCase;
use Yasumi\Tests\YasumiBase;

/**
 * Base class for test cases of the Melilla (Spain) holiday provider.
 */
abstract class MelillaBaseTestCase extends SpainBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'Spain/Melilla';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Madrid';

    /**
     * List of holidays (shortnames) that are generally expected to be defined
     */
    public static $expectedHolidays = [
        'newYearsDay',
        'epiphany',
        'valentinesDay',
        'stJosephsDay',
        'maundyThursday',
        'goodFriday',
        'easter',
        'internationalWorkersDay',
        'assumptionOfMary',
        'nationalDay',
        'allSaintsDay',
        'constitutionDay',
        'immaculateConception',
        'christmasDay'
    ];
}
