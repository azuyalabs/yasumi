<?php

namespace Yasumi\tests;

use Yasumi\ProviderInterface;

class YasumiExternalProvider implements ProviderInterface
{
    /**
     * Initialize country holidays.
     */
    public function initialize()
    {
        // We don't actually have to do anything here.
    }
}
