<?php

declare(strict_types=1);

namespace Yasumi\tests\Peru;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Class PeruBaseTestCase.
 */
abstract class PeruBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested.
     */
    public const REGION = 'Peru';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'America/Lima';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'es_ES';
}
