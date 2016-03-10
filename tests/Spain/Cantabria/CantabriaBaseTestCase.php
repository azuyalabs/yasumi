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
namespace Yasumi\Tests\Spain\Cantabria;

use Yasumi\Tests\Spain\SpainBaseTestCase;
use Yasumi\Tests\YasumiBase;

/**
 * Base class for test cases of the Cantabria (Spain) holiday provider.
 */
abstract class CantabriaBaseTestCase extends SpainBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'Spain/Cantabria';

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
        'maundyThursday',
        'goodFriday',
        'easter',
        'internationalWorkersDay',
        'assumptionOfMary',
        'cantabriaDay',
        'nationalDay',
        'allSaintsDay',
        'constitutionDay',
        'immaculateConception',
        'christmasDay'
    ];
}
