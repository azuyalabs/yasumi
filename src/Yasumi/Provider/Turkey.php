<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider;

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;

class Turkey extends AbstractProvider
{
    use CommonHolidays;

    /** {@inheritdoc} */
    public const ID = 'TR';

    /**
     * Initialize holidays for Turkey.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Istanbul';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
    }

    /** {@inheritdoc} */
    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Turkey',
            'https://tr.wikipedia.org/wiki/T%C3%BCrkiye%27deki_resm%C3%AE_tatiller',
        ];
    }
}
