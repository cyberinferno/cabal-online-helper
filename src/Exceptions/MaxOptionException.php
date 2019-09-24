<?php

namespace cyberinferno\Cabal\Helpers\Exceptions;

/**
 * Class MaxOptionException
 *
 * Exception thrown when maximum option has been reached while generating item option
 *
 * @package cyberinferno\Cabal\Helpers\Exceptions
 * @author Karthik P
 */
class MaxOptionException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null) {
        if (empty($message)) {
            $message = 'Maximum number of options cannot exceed the limit set';
        }
        parent::__construct($message, $code, $previous);
    }
}