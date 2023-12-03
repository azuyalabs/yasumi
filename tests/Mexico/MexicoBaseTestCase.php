<?php

declare(strict_types=1);

namespace Yasumi\tests\Mexico;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Class MexicoBaseTestCase.
 */
abstract class MexicoBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested.
     */
    public const REGION = 'Mexico';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'America/Mexico_City';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'es_MX';
}
