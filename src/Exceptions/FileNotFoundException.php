<?php

namespace cyberinferno\Cabal\Helpers\Exceptions;

/**
 * Class FileNotFoundException
 *
 * Exception thrown when a specified file was not found or could not be accessed
 *
 * @package cyberinferno\Cabal\Helpers\Exceptions
 * @author Karthik P
 */
class FileNotFoundException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null) {
        if (empty($message)) {
            $message = 'File not found';
        }
        parent::__construct($message, $code, $previous);
    }
}