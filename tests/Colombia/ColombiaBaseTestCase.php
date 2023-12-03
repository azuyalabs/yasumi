<?php

declare(strict_types=1);

namespace Yasumi\tests\Colombia;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Class ColombiaBaseTestCase.
 */
abstract class ColombiaBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested.
     */
    public const REGION = 'Colombia';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'America/Bogota';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'es_CO';
}
