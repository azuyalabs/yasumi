<?php
declare(strict_types=1);
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

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;
use Yasumi\Yasumi;

/**
 * Class TypographyTest.
 *
 * Verifies that translations uses typographic apostrophe (’) and quotation marks (“ ”)
 * rather than their typewriter versions (' and ").
 *
 * @link https://en.wikipedia.org/wiki/Apostrophe
 * @link https://en.wikipedia.org/wiki/Quotation_mark
 */
class TypographyTest extends TestCase
{
    use YasumiBase;

    /**
     * @dataProvider translationProvider
     *
     * @param string $name The localized holiday name
     * @param string $class The provider
     * @param string $key The holiday key
     * @param string $locale The locale
     */
    public function testTranslations($name, $class, $key, $locale): void
    {
        $this->assertStringNotContainsString("'", $name, 'Translation contains typewriter apostrophe');
        $this->assertStringNotContainsString('"', $name, 'Translation contains typewriter quote');
    }

    /**
     * Provides test data for testProvider().
     * @throws \ReflectionException
     */
    public function translationProvider(): array
    {
        $classes = Yasumi::getProviders();

        $tests = [];

        foreach ($classes as $class) {
            $provider = Yasumi::create($class, $this->generateRandomYear());

            foreach ($provider->getHolidays() as $holiday) {
                foreach ($holiday->translations as $locale => $name) {
                    $tests[$name] = [$name, $class, $holiday->getKey(), $locale];
                }
            }
        }

        return \array_values($tests);
    }
}
