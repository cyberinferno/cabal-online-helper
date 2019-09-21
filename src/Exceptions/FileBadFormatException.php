<?php

namespace cyberinferno\Cabal\Helpers\Exceptions;

/**
 * Class FileBadFormatException
 *
 * Exception thrown when a specified file is not in expected format
 *
 * @package cyberinferno\Cabal\Helpers\Exceptions
 * @author Karthik P
 */
class FileBadFormatException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null) {
        if (empty($message)) {
            $message = 'Format of the specified file was bad and hence could not be read';
        }
        parent::__construct($message, $code, $previous);
    }
}