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

namespace Yasumi\tests\Base;

use InvalidArgumentException;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Translations;

/**
 * Class TranslationsTest.
 *
 * Contains tests for testing the Translations class
 */
class TranslationsTest extends TestCase
{
    public const LOCALES = [
        'en_US',
        'nl_NL',
        'pl_PL',
    ];

    /**
     * Tests adding single translation.
     */
    public function testAddTranslation(): void
    {
        $translations = new Translations(self::LOCALES);

        $locale = 'en_US';
        $key = 'newYearsDay';
        $translation = 'New Year’s Day';

        $this->assertNull($translations->getTranslation($key, $locale));
        $this->assertEmpty($translations->getTranslations($key));

        $translations->addTranslation($key, $locale, $translation);

        $this->assertNotNull($translations->getTranslations($key));
        $this->assertNotEmpty($translations->getTranslations($key));
        $this->assertEquals([$locale => $translation], $translations->getTranslations($key));

        $this->assertNotNull($translations->getTranslation($key, $locale));
        $this->assertIsString($translations->getTranslation($key, $locale));
        $this->assertEquals($translation, $translations->getTranslation($key, $locale));
    }

    /**
     * Tests adding multiple translations.
     */
    public function testAddMultipleTranslations(): void
    {
        $translations = new Translations(self::LOCALES);

        $firstLocale = 'en_US';
        $firstIdentifier = 'newYearsDay';
        $firstTranslation = 'New Year’s Day';

        $translations->addTranslation($firstIdentifier, $firstLocale, $firstTranslation);

        $this->assertNotNull($translations->getTranslations($firstIdentifier));
        $this->assertNotEmpty($translations->getTranslations($firstIdentifier));
        $this->assertEquals([$firstLocale => $firstTranslation], $translations->getTranslations($firstIdentifier));

        $this->assertNotNull($translations->getTranslation($firstIdentifier, $firstLocale));
        $this->assertIsString($translations->getTranslation($firstIdentifier, $firstLocale));
        $this->assertEquals($firstTranslation, $translations->getTranslation($firstIdentifier, $firstLocale));

        $secondLocale = 'nl_NL';
        $secondIdentifier = 'easter';
        $secondTranslation = 'Eerste paasdag';

        $translations->addTranslation($secondIdentifier, $secondLocale, $secondTranslation);

        $this->assertNotNull($translations->getTranslations($secondIdentifier));
        $this->assertNotEmpty($translations->getTranslations($secondIdentifier));
        $this->assertEquals([$secondLocale => $secondTranslation], $translations->getTranslations($secondIdentifier));

        $this->assertNotNull($translations->getTranslation($secondIdentifier, $secondLocale));
        $this->assertIsString($translations->getTranslation($secondIdentifier, $secondLocale));
        $this->assertEquals($secondTranslation, $translations->getTranslation($secondIdentifier, $secondLocale));

        $thirdLocale = 'en_US';
        $thirdIdentifier = 'easter';
        $thirdTranslation = 'Easter Sunday';

        $translations->addTranslation($thirdIdentifier, $thirdLocale, $thirdTranslation);

        $this->assertNotNull($translations->getTranslations($thirdIdentifier));
        $this->assertNotEmpty($translations->getTranslations($thirdIdentifier));
        $this->assertEquals(
            [$thirdLocale => $thirdTranslation, $secondLocale => $secondTranslation],
            $translations->getTranslations($thirdIdentifier)
        );

        $this->assertNotNull($translations->getTranslation($thirdIdentifier, $thirdLocale));
        $this->assertIsString($translations->getTranslation($thirdIdentifier, $thirdLocale));
        $this->assertEquals($thirdTranslation, $translations->getTranslation($thirdIdentifier, $thirdLocale));
    }

    /**
     * Tests that an UnknownLocaleException is thrown when adding translation for unknown locale.
     *
     */
    public function testAddTranslationUnknownLocaleException(): void
    {
        $this->expectException(UnknownLocaleException::class);

        $translations = new Translations(self::LOCALES);

        $unknownLocale = 'en_XY';
        $key = 'newYearsDay';
        $translation = 'New Year’s Day';

        $translations->addTranslation($key, $unknownLocale, $translation);
    }

    /**
     * Tests that no translation is returned for an unknown holiday.
     */
    public function testNoTranslationForUnknownHoliday(): void
    {
        $translations = new Translations(self::LOCALES);

        $locale = 'en_US';
        $key = 'newYearsDay';
        $translation = 'New Year’s Day';

        $unknownIdentifier = 'unknownHoliday';

        $translations->addTranslation($key, $locale, $translation);

        $this->assertNull($translations->getTranslation($unknownIdentifier, $locale));
        $this->assertEmpty($translations->getTranslations($unknownIdentifier));
    }

    /**
     * Tests that no translation is returned for not translated locale.
     */
    public function testNoTranslationForNotTranslatedLocale(): void
    {
        $translations = new Translations(self::LOCALES);

        $locale = 'en_US';
        $key = 'newYearsDay';
        $translation = 'New Year’s Day';

        $unknownLocale = 'pl_PL';

        $translations->addTranslation($key, $locale, $translation);

        $this->assertNull($translations->getTranslation($key, $unknownLocale));
    }

    /**
     * Tests loading one translation file from directory.
     */
    public function testLoadingTranslationsFromDirectory(): void
    {
        $key = 'newYearsDay';
        $fileContents = <<<'FILE'
<?php
return [
    'en_US' => 'New Year’s Day',
    'nl_NL' => 'Nieuwjaar',
    'pl_PL' => 'Nowy Rok',
];
FILE;

        vfsStream::setup('root', null, ['lang' => [$key . '.php' => $fileContents]]);

        $translations = new Translations(self::LOCALES);
        $translations->loadTranslations(vfsStream::url('root/lang'));

        $locale = 'en_US';
        $translation = 'New Year’s Day';

        $this->assertNotNull($translations->getTranslations($key));
        $this->assertNotEmpty($translations->getTranslations($key));
        $this->assertIsString($translations->getTranslation($key, $locale));
        $this->assertEquals($translation, $translations->getTranslation($key, $locale));
    }

    /**
     * Tests that translation is not loaded from file with invalid extension.
     */
    public function testNotLoadingTranslationsFromFileWithInvalidExtension(): void
    {
        $key = 'newYearsDay';
        $fileContents = <<<'FILE'
<?php
return [
    'en_US' => 'New Year’s Day',
    'nl_NL' => 'Nieuwjaar',
    'pl_PL' => 'Nowy Rok',
];
FILE;

        vfsStream::setup('root', null, ['lang' => [$key . '.translation' => $fileContents]]);

        $translations = new Translations(self::LOCALES);
        $translations->loadTranslations(vfsStream::url('root/lang'));

        $this->assertNotNull($translations->getTranslations($key));
        $this->assertEmpty($translations->getTranslations($key));
    }

    /**
     * Tests that an UnknownLocaleException is thrown when loading translation with unknown locale(s).
     *
     */
    public function testLoadingTranslationsFromDirectoryWithUnknownLocaleException(): void
    {
        $this->expectException(UnknownLocaleException::class);

        $key = 'newYearsDay';
        $fileContents = <<<'FILE'
<?php
return [
    'en_XY' => 'New Year’s Day',
    'nl_NL' => 'Nieuwjaar',
];
FILE;

        vfsStream::setup('root', null, ['lang' => [$key . '.php' => $fileContents]]);

        $translations = new Translations(self::LOCALES);
        $translations->loadTranslations(vfsStream::url('root/lang'));
    }

    /**
     * Tests that an InvalidArgumentException is thrown when loading translation from inexistent directory.
     *
     */
    public function testLoadingTranslationsFromInexistentDirectory(): void
    {
        $this->expectException(InvalidArgumentException::class);

        vfsStream::setup();

        $translations = new Translations(self::LOCALES);
        $translations->loadTranslations(vfsStream::url('root/lang'));
    }

    /**
     * Tests loading more than one translation file from directory.
     */
    public function testLoadingMultipleTranslationsFromDirectory(): void
    {
        $firstIdentifier = 'newYearsDay';
        $firstFileContents = <<<'FILE'
<?php
return [
    'en_US' => 'New Year’s Day',
    'nl_NL' => 'Nieuwjaar',
    'pl_PL' => 'Nowy Rok',
];
FILE;

        $secondIdentifier = 'easter';
        $secondFileContents = <<<'FILE'
<?php
return [
    'en_US' => 'Easter Sunday',
    'nl_NL' => 'Eerste Paasdag',
];
FILE;

        vfsStream::setup('root', null, [
            'lang' => [
                $firstIdentifier . '.php' => $firstFileContents,
                $secondIdentifier . '.php' => $secondFileContents,
            ],
        ]);

        $translations = new Translations(self::LOCALES);

        $translations->loadTranslations(vfsStream::url('root/lang'));

        $locale = 'en_US';
        $translation = 'New Year’s Day';

        $this->assertNotNull($translations->getTranslations($firstIdentifier));
        $this->assertNotEmpty($translations->getTranslations($firstIdentifier));
        $this->assertIsString($translations->getTranslation($firstIdentifier, $locale));
        $this->assertEquals($translation, $translations->getTranslation($firstIdentifier, $locale));

        $locale = 'nl_NL';
        $translation = 'Eerste Paasdag';

        $this->assertNotNull($translations->getTranslations($secondIdentifier));
        $this->assertNotEmpty($translations->getTranslations($secondIdentifier));
        $this->assertIsString($translations->getTranslation($secondIdentifier, $locale));
        $this->assertEquals($translation, $translations->getTranslation($secondIdentifier, $locale));
    }
}
