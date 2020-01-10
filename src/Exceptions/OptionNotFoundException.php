<?php


namespace cyberinferno\Cabal\Helpers\Exceptions;

/**
 * Class OptionNotFoundException
 *
 * Exception thrown when an option is not present in an item
 *
 * @package cyberinferno\Cabal\Helpers\Exceptions
 * @author Karthik P
 */
class OptionNotFoundException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null) {
        if (empty($message)) {
            $message = 'Option not found';
        }
        parent::__construct($message, $code, $previous);
    }
}