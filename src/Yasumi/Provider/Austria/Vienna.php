<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider\Austria;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Austria;

/**
 * Provider for all holidays in Vienna (Austria).
 *
 * @link https://en.wikipedia.org/wiki/Vienna
 */
class Vienna extends Austria
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AT-9';

    /**
     * Initialize holidays for Vienna (Austria).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom holidays.
        $this->calculateStLeopoldsDay();
    }

    /**
     * Saint Leopold's Day.
     *
     * Saint Leopold III, known as Leopold the Good, was the Margrave of Austria
     * from 1095 to his death in 1136. He was a member of the House of
     * Babenberg. He was canonized on 6 January 1485 and became the patron saint
     * of Austria, Lower Austria, Upper Austria, and Vienna. His feast day is 15
     * November.
     *
     * @link https://en.wikipedia.org/wiki/Leopold_III,_Margrave_of_Austria
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateStLeopoldsDay(): void
    {
      $this->addHoliday(new Holiday(
        'stLeopoldsDay',
        [],
        new DateTime($this->year . '-11-15', new \DateTimeZone($this->timezone)),
        $this->locale
      ));
    }
}
