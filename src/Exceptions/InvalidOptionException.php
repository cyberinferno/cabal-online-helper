<?php

namespace cyberinferno\Cabal\Helpers\Exceptions;

/**
 * Class InvalidOptionException
 *
 * Exception thrown if option being set is invalid
 *
 * @package cyberinferno\Cabal\Helpers\Exceptions
 * @author Karthik P
 */
class InvalidOptionException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null) {
        if (empty($message)) {
            $message = 'Invalid option';
        }
        parent::__construct($message, $code, $previous);
    }
}