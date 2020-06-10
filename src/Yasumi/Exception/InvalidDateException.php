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

namespace Yasumi\Exception;

use InvalidArgumentException;

/**
 * Class InvalidDateException.
 */
class InvalidDateException extends InvalidArgumentException implements Exception
{

    /**
     * Initializes the Exception instance
     *
     * @param mixed $argumentValue The value of the invalid argument
     */
    public function __construct($argumentValue)
    {
        $type = \gettype($argumentValue);
        switch ($type) {
            case 'boolean':
                $displayName = $argumentValue ? 'true' : 'false';
                break;
            case 'integer':
            case 'double':
                $displayName = (string) $argumentValue;
                break;
            case 'string':
                $displayName = $argumentValue;
                break;
            case 'object':
                $displayName = \get_class($argumentValue);
                break;
            default:
                $displayName = $type;
                break;
        }

        parent::__construct(\sprintf(\sprintf('\'%s\' is not a valid DateTime(Immutable) instance', $displayName)));
    }
}
