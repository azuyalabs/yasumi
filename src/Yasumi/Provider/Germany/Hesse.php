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

namespace Yasumi\Provider\Germany;

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Hesse (Germany).
 *
 * Hesse is a federal state (Land) of the Federal Republic of Germany, with just over six million inhabitants. The state
 * capital is Wiesbaden; the largest city is Frankfurt am Main. Until the formation of the German Reich in 1871, Hesse
 * was an independent country ruled by a Grand Duke (Grand Duchy of Hesse). Due to divisions after World War II, the
 * modern federal state does not cover the entire cultural region of Hesse which includes both the State of Hesse and
 * the area known as Rhenish Hesse (Rheinhessen) in the neighbouring state of Rhineland-Palatinate.
 *
 * @see https://en.wikipedia.org/wiki/Hesse
 */
class Hesse extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-HE';

    /**
     * Initialize holidays for Hesse (Germany).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale));
    }
}
