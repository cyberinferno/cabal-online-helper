<?php

namespace cyberinferno\Cabal\Helpers\Exceptions;

/**
 * Class OptionLimitException
 *
 * Exception thrown when maximum option limit has been reached while generating item option
 *
 * @package cyberinferno\Cabal\Helpers\Exceptions
 * @author Karthik P
 */
class OptionLimitException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null) {
        if (empty($message)) {
            $message = 'Options cannot exceed the limit set while initialising item option object';
        }
        parent::__construct($message, $code, $previous);
    }
}