<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi;

use Yasumi\Exception\InvalidYearException;
use Yasumi\Exception\ProviderNotFoundException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Provider\AbstractProvider;

/**
 * Class Yasumi.
 */
class Yasumi
{
    public const DEFAULT_LOCALE = 'en_US';

    public const YEAR_LOWER_BOUND = 1000;

    public const YEAR_UPPER_BOUND = 9999;

    /**
     * @var array<string> list of all defined locales
     */
    private static array $locales = [];

    /** Global translations */
    private static ?Translations $globalTranslations = null;

    /**
     * Provider class to be ignored (Abstract, trait, other).
     *
     * @var array<string>
     */
    private static array $ignoredProvider = [
        'AbstractProvider.php',
        'CommonHolidays.php',
        'ChristianHolidays.php',
    ];

    /**
     * Determines the next working day based on a given start date.
     *
     * The next working day based on a given start date excludes any holidays and weekends that may be defined
     * by this Holiday Provider. The workingDays parameter can be used how far ahead (in days) the next working day
     * must be searched for.
     *
     * @param string             $class       Holiday Provider name
     * @param \DateTimeInterface $startDate   Start date, defaults to today
     * @param int                $workingDays Number of days to look ahead for the (first) next working day
     *
     * @throws UnknownLocaleException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Exception
     *
     * @TODO we should accept a timezone so we can accept int/string for $startDate
     */
    public static function nextWorkingDay(
        string $class,
        \DateTimeInterface $startDate,
        int $workingDays = 1
    ): \DateTimeInterface {
        $date = $startDate instanceof \DateTime ? \DateTimeImmutable::createFromMutable($startDate) : $startDate;
        $provider = null;

        while ($workingDays > 0) {
            $date = $date->add(new \DateInterval('P1D'));

            if (! $date instanceof \DateTimeImmutable) {
                throw new \RuntimeException('Unable to perform date interval addition');
            }

            if (! $provider instanceof ProviderInterface || $provider->getYear() !== (int) $date->format('Y')) {
                $provider = self::create($class, (int) $date->format('Y'));
            }

            if ($provider->isWorkingDay($date)) {
                --$workingDays;
            }
        }

        return $date;
    }

    /**
     * Create a new holiday provider instance.
     *
     * A new holiday provider instance can be created using this function. You can use one of the providers included
     * already with Yasumi, or your own provider by giving the name of your class in the first parameter. Your provider
     * class needs to implement the 'ProviderInterface' class.
     *
     * @param string $class  holiday provider name
     * @param int    $year   year for which the country provider needs to be created. Year needs to be a valid integer
     *                       between the defined lower and upper bounds.
     * @param string $locale The locale to use. If empty we'll use the default locale (en_US)
     *
     * @return ProviderInterface An instance of class $class is created and returned
     *
     * @throws \RuntimeException         If no such holiday provider is found
     * @throws InvalidYearException      if the year parameter is not between the defined lower and upper bounds
     * @throws UnknownLocaleException    if the locale parameter is invalid
     * @throws ProviderNotFoundException if the holiday provider for the given country does not exist
     */
    public static function create(string $class, int $year = self::YEAR_LOWER_BOUND, string $locale = self::DEFAULT_LOCALE): ProviderInterface
    {
        // Find and return holiday provider instance
        $providerClass = sprintf('Yasumi\Provider\%s', str_replace('/', '\\', $class));

        if (class_exists($class) && (new \ReflectionClass($class))->implementsInterface(ProviderInterface::class)) {
            $providerClass = $class;
        }

        if ('AbstractProvider' === $class || ! class_exists($providerClass)) {
            throw new ProviderNotFoundException(sprintf('Unable to find holiday provider "%s".', $class));
        }

        // Assert year input
        if ($year < self::YEAR_LOWER_BOUND || $year > self::YEAR_UPPER_BOUND) {
            throw new InvalidYearException(sprintf('Year needs to be between %d and %d (%d given).', self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND, $year));
        }

        // Load internal locales variable
        if ([] === self::$locales) {
            self::$locales = self::getAvailableLocales();
        }

        // Load internal translations variable
        if (! self::$globalTranslations instanceof Translations) {
            self::$globalTranslations = new Translations(self::$locales);
            self::$globalTranslations->loadTranslations(__DIR__.'/data/translations');
        }

        // Assert locale input
        if (! \in_array($locale, self::$locales, true)) {
            throw new UnknownLocaleException(sprintf('Locale "%s" is not a valid locale.', $locale));
        }

        return new $providerClass($year, $locale, self::$globalTranslations);
    }

    /**
     * Returns a list of available locales.
     *
     * @return array<string> list of available locales
     */
    public static function getAvailableLocales(): array
    {
        return require __DIR__.'/data/locales.php';
    }

    /**
     * Create a new holiday provider instance.
     *
     * A new holiday provider instance can be created using this function. You can use one of the providers included
     * already with Yasumi, or your own provider by giving the 'const ID', corresponding to the ISO3166-2 Code, set in
     * your class in the first parameter. Your provider class needs to implement the 'ProviderInterface' class.
     *
     * @param string $isoCode ISO3166-2 Coded region, holiday provider will be searched for
     * @param int    $year    year for which the country provider needs to be created. Year needs to be a valid
     *                        integer between the defined lower and upper bounds.
     * @param string $locale  The locale to use. If empty we'll use the default locale (en_US)
     *
     * @return ProviderInterface An instance of class $class is created and returned
     *
     * @throws \RuntimeException         If no such holiday provider is found
     * @throws \InvalidArgumentException if the year parameter is not between the defined lower and upper bounds
     * @throws UnknownLocaleException    if the locale parameter is invalid
     * @throws ProviderNotFoundException if the holiday provider for the given ISO3166-2 code does not exist
     * @throws \ReflectionException
     */
    public static function createByISO3166_2(
        string $isoCode,
        int $year = self::YEAR_LOWER_BOUND,
        string $locale = self::DEFAULT_LOCALE
    ): ProviderInterface {
        $availableProviders = self::getProviders();

        if (! isset($availableProviders[$isoCode])) {
            throw new ProviderNotFoundException(sprintf('Unable to find holiday provider by ISO3166-2 "%s".', $isoCode));
        }

        return self::create($availableProviders[$isoCode], $year, $locale);
    }

    /**
     * Returns a list of available holiday providers.
     *
     * @return array<string, array<array-key, string>|string|null> list of available holiday providers
     *
     * @throws \ReflectionException
     */
    public static function getProviders(): array
    {
        // Basic static cache
        static $providers;
        if (null !== $providers && [] !== $providers) {
            return $providers;
        }

        $providers = [];
        $filesIterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(
            __DIR__.\DIRECTORY_SEPARATOR.'Provider',
            \FilesystemIterator::SKIP_DOTS
        ), \RecursiveIteratorIterator::SELF_FIRST);

        /** @var \SplFileInfo $file */
        foreach ($filesIterator as $file) {
            if ($file->isDir()) {
                continue;
            }

            if ('php' !== $file->getExtension()) {
                continue;
            }

            if (\in_array(
                $file->getBasename('.php'),
                self::$ignoredProvider,
                true
            )) {
                continue;
            }
            $quotedDs = preg_quote(\DIRECTORY_SEPARATOR, '');
            $provider = preg_replace("#^.+{$quotedDs}Provider{$quotedDs}(.+)\\.php$#", '$1', $file->getPathName());

            $class = new \ReflectionClass(sprintf('Yasumi\Provider\%s', str_replace('/', '\\', $provider)));

            $key = 'ID';

            if (! $class->isSubclassOf(AbstractProvider::class)) {
                continue;
            }

            if (! $class->hasConstant($key)) {
                continue;
            }

            $providers[strtoupper($class->getConstant($key))] = $provider;
        }

        return $providers;
    }

    /**
     * Determines the previous working day based on a given start date.
     *
     * The previous working day based on a given start date excludes any holidays and weekends that may be defined
     * by this Holiday Provider. The workingDays parameter can be used how far back (in days) the previous working day
     * must be searched for.
     *
     * @param string             $class       Holiday Provider name
     * @param \DateTimeInterface $startDate   Start date, defaults to today
     * @param int                $workingDays Number of days to look back for the (first) previous working day
     *
     * @throws UnknownLocaleException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Exception
     *
     * @TODO we should accept a timezone so we can accept int/string for $startDate
     */
    public static function prevWorkingDay(
        string $class,
        \DateTimeInterface $startDate,
        int $workingDays = 1
    ): \DateTimeInterface {
        $date = $startDate instanceof \DateTime ? \DateTimeImmutable::createFromMutable($startDate) : $startDate;
        $provider = null;

        while ($workingDays > 0) {
            $date = $date->sub(new \DateInterval('P1D'));

            if (! $date instanceof \DateTimeImmutable) {
                throw new \RuntimeException('Unable to perform date interval subtraction');
            }

            if (! $provider instanceof ProviderInterface || $provider->getYear() !== (int) $date->format('Y')) {
                $provider = self::create($class, (int) $date->format('Y'));
            }

            if ($provider->isWorkingDay($date)) {
                --$workingDays;
            }
        }

        return $date;
    }
}
