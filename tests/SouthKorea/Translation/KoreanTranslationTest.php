<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\SouthKorea\Translation;

use PHPUnit\Framework\Attributes\DataProvider;
use Yasumi\Provider\SouthKorea\Translation\KoreanTranslation;
use Yasumi\tests\SouthKorea\SouthKoreaBaseTestCase;

class KoreanTranslationTest extends SouthKoreaBaseTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'liberationDay';

    public const YEAR_LOWER_BOUND = 2023;

    public const YEAR_UPPER_BOUND = 9999;

    /**
     * Tests injecting translation data into the class constructor.
     *
     * @throws \Exception
     */
    #[DataProvider('YearsDataProvider')]
    public function testConstructor(int $year): void
    {
        $translation = new KoreanTranslation($year, []);
        $this->assertEmpty($translation->getTranslations(self::HOLIDAY));

        $translations[self::HOLIDAY]['en'] = 'Liberation Day';
        $translations[self::HOLIDAY]['ko'] = '광복절';

        $translation = new KoreanTranslation($year, $translations);
        $this->assertArrayIsIdenticalToArrayOnlyConsideringListOfKeys($translations[self::HOLIDAY], $translation->getTranslations(self::HOLIDAY), ['en']);

        $this->assertSame('Liberation Day', $translation->getTranslations(self::HOLIDAY)['en']);
        $this->assertSame('광복절', $translation->getTranslations(self::HOLIDAY)['ko']);
    }

    /**
     * Test method functionality such as lookup after adding translations.
     *
     * @throws \Exception
     */
    #[DataProvider('YearsDataProvider')]
    public function testMethods(int $year): void
    {
        $translation = new KoreanTranslation($year, []);
        $this->assertEmpty($translation->getTranslations(self::HOLIDAY));

        $translation->addTranslation(self::HOLIDAY, 'Liberation Day', 'en');
        $translation->addTranslation(self::HOLIDAY, '광복절', 'ko');

        $this->assertNotEmpty($translation->getTranslations(self::HOLIDAY));
        $this->assertArrayIsIdenticalToArrayOnlyConsideringListOfKeys([
            'en' => 'Liberation Day',
            'ko' => '광복절',
        ], $translation->getTranslations(self::HOLIDAY), ['en', 'ko']);
    }

    public static function YearsDataProvider(): \Generator
    {
        for ($i = 0; $i < 20; ++$i) {
            yield [static::numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND)];
        }
    }
}
