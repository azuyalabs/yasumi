<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Note: Any Islamic holidays are not part of this provider yet. Islamic holidays are quite complex and at first,
 * only Jalali holidays are implemented.
 */
class Iran extends AbstractProvider
{
    /** {@inheritdoc} */
    public const ID = 'IR';

    /**
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Asia/Tehran';

        $this->addNowruz();
        $this->addIslamicRepublicDay();
        $this->addSizdahBedar();
        $this->addDeathOfKhomeini();
        $this->addRevoltOfKhordad15();
        $this->addAnniversaryOfIslamicRevolution();
        $this->addNationalizationOfTheIranianOilIndustry();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Iran',
            'https://fa.wikipedia.org/wiki/%D8%AA%D8%B9%D8%B7%DB%8C%D9%84%D8%A7%D8%AA_%D8%B1%D8%B3%D9%85%DB%8C_%D8%AF%D8%B1_%D8%A7%DB%8C%D8%B1%D8%A7%D9%86',
        ];
    }

    protected function addNowruz(): void
    {
        foreach ([21, 22, 23, 24] as $index => $day) {
            ++$index;
            $this->addHoliday(new Holiday("nowruz{$index}", [
                'en' => 'Nowruz',
                'fa' => 'نوروز',
            ], new \DateTime("{$this->year}-03-{$day}", new \DateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * The day usually falls on 1 April, however, as it is determined by the vernal equinox, the date can change if the equinox does not fall on 21 March.
     * In 2016, it was on 31 March, and in 2017, 2019, 2021, 2022 and 2023 the date was back to 1 April.
     *
     * @see https://en.wikipedia.org/wiki/Iranian_Islamic_Republic_Day
     *
     * @throws \Exception
     */
    protected function addIslamicRepublicDay(): void
    {
        if (1979 > $this->year) {
            return;
        }

        $month = '04';
        $day = '01';

        if (2016 === $this->year) {
            $month = '03';
            $day = '31';
        }

        $this->addHoliday(new Holiday('islamicRepublicDay', [
            'en' => 'Ruz e Jomhuri ye Eslami',
            'fa' => 'روز جمهوری اسلامی',
        ], new \DateTime("{$this->year}-{$month}-{$day}", new \DateTimeZone($this->timezone)), $this->locale));
    }

    protected function addSizdahBedar(): void
    {
        $this->addHoliday(new Holiday('sizdahBedar', [
            'en' => 'Sizdah be dar',
            'fa' => 'سیزده بدر',
        ], new \DateTime("{$this->year}-04-02", new \DateTimeZone($this->timezone)), $this->locale));
    }

    protected function addDeathOfKhomeini(): void
    {
        if (1989 > $this->year) {
            return;
        }

        $this->addHoliday(new Holiday('deathOfKhomeini', [
            'en' => 'Marg e Khomeini',
            'fa' => 'مرگ خمینی',
        ], new \DateTime("{$this->year}-06-04", new \DateTimeZone($this->timezone)), $this->locale));
    }

    protected function addRevoltOfKhordad15(): void
    {
        if (1979 > $this->year) {
            return;
        }

        $this->addHoliday(new Holiday('revoltOfKhordad15', [
            'en' => 'Qiam e Panzdah e Khordad',
            'fa' => 'قیام ۱۵ خرداد',
        ], new \DateTime("{$this->year}-06-05", new \DateTimeZone($this->timezone)), $this->locale));
    }

    protected function addAnniversaryOfIslamicRevolution(): void
    {
        if (1979 > $this->year) {
            return;
        }

        $this->addHoliday(new Holiday('anniversaryOfIslamicRevolution', [
            'en' => 'Enqelab e Eslami',
            'fa' => 'انقلاب اسلامی پنجاه و هفت',
        ], new \DateTime("{$this->year}-02-11", new \DateTimeZone($this->timezone)), $this->locale));
    }

    protected function addNationalizationOfTheIranianOilIndustry(): void
    {
        if (1951 > $this->year) {
            return;
        }

        $this->addHoliday(new Holiday('nationalizationOfTheIranianOilIndustry', [
            'en' => 'Melli Shodan e Saneat e Naft',
            'fa' => 'ملی شدن صنعت نفت',
        ], new \DateTime("{$this->year}-03-20", new \DateTimeZone($this->timezone)), $this->locale));
    }
}
