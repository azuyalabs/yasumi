<?php
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

namespace Yasumi\Provider;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in India.
 */
class India extends AbstractProvider
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'IN';

    /**
     * Initialize holidays for India.
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Asia/Kolkata';

        $this->calculateRepublicDay();
        $this->calculateIndependenceDay();
        $this->calculateMahatmaGandhisBirthday();
    }

    /**
     * Republic Day.
     *
     * Republic Day honours the date on which the Constitution of India came into effect on 26 January 1950
     * replacing the Government of India Act (1935) as the governing document of India.
     *
     * The main Republic Day celebration is held in the national capital, New Delhi, at the Rajpath before
     * the President of India. On this day, ceremonious parades take place at the Rajpath, which are
     * performed as a tribute to India; its unity in diversity and rich cultural heritage.
     *
     * @link https://en.wikipedia.org/wiki/Republic_Day_(India)
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    private function calculateRepublicDay(): void
    {
        // Not sure when this day was made an official holiday, but it cannot be
        // earlier than the event it is commemorating.
        if ($this->year >= 1950) {
            $this->addHoliday(new Holiday(
                'republicDay',
                [],
                new DateTime("$this->year-1-26", new DateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Independence Day
     *
     * Independence Day is annually celebrated on 15 August, as a national holiday in India commemorating the
     * nation's independence from the United Kingdom on 15 August 1947, the day when the UK Parliament passed the
     * Indian Independence Act 1947 transferring legislative sovereignty to the Indian Constituent Assembly.
     *
     * @link https://en.wikipedia.org/wiki/Independence_Day_(India)
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    private function calculateIndependenceDay(): void
    {
        // Not sure when this day was made an official holiday, but it cannot be
        // earlier than the event it is commemorating.
        if ($this->year >= 1947) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                [],
                new DateTime("$this->year-8-15", new DateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Mahatma Gandhi's birthday (Gandhi Jayanti).
     *
     * Honors Mohandas Karamchand Gandhi born 2 October 1869. Gandhi was an Indian lawyer, anti-colonial nationalist,
     * and political ethicist, who employed nonviolent resistance to lead the successful campaign for India's
     * independence from British Rule, and in turn inspire movements for civil rights and freedom across the world.
     *
     * In 2007, the UN General Assembly declared 2 October as the International Day of Non-Violence.
     *
     * @link https://en.wikipedia.org/wiki/Gandhi_Jayanti
     * @link https://en.wikipedia.org/wiki/International_Day_of_Non-Violence
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    private function calculateMahatmaGandhisBirthday(): void
    {
        // Not sure when this day was made an official holiday, but it cannot be
        // older than Gandhi himself.
        if ($this->year >= 1869) {
            $this->addHoliday(new Holiday(
                'mahatmaGandhisBirthday',
                [],
                new DateTime("$this->year-8-15", new DateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
