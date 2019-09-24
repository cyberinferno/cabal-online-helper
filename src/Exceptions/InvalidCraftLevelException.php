<?php

namespace cyberinferno\Cabal\Helpers\Exceptions;

/**
 * Class InvalidCraftLevelException
 *
 * Exception thrown if craft level being set is invalid
 *
 * @package cyberinferno\Cabal\Helpers\Exceptions
 * @author Karthik P
 */
class InvalidCraftLevelException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null) {
        if (empty($message)) {
            $message = 'Invalid craft level';
        }
        parent::__construct($message, $code, $previous);
    }
}