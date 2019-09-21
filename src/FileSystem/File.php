<?php

namespace cyberinferno\Cabal\Helpers\FileSystem;

use cyberinferno\Cabal\Helpers\Exceptions\FileBadFormatException;
use cyberinferno\Cabal\Helpers\Exceptions\FileNotFoundException;

/**
 * Class File
 *
 * Base class for all file system classes. Has basic file loading and validating methods
 *
 * @package cyberinferno\Cabal\Helpers\FileSystem
 * @author Karthik P
 */
abstract class File
{
    protected $_filePath;
    protected $_fileContents;

    /**
     * File constructor.
     * @param string $filePath
     * @throws FileBadFormatException
     * @throws FileNotFoundException
     */
    public function __construct($filePath)
    {
        $this->_filePath = $filePath;
        $this->validateFileExists();
        $this->validateFormat();
    }

    /**
     * Checks whether the specified file exists
     *
     * @throws FileNotFoundException
     */
    protected function validateFileExists()
    {
        if (file_exists($this->_filePath) === false) {
            throw new FileNotFoundException();
        }
    }

    /**
     * Checks whether the specified file isn't empty
     *
     * @throws FileBadFormatException
     */
    protected function validateFormat()
    {
        if (filesize($this->_filePath) == 0 || $this->getFileContents() === null) {
            throw new FileBadFormatException();
        }
    }

    /**
     * Loads the file contents if not already loaded and returns the same
     *
     * @return null|string
     */
    public function getFileContents()
    {
        if (isset($this->_fileContents) === false) {
            $this->_fileContents = file_get_contents($this->_filePath);
        }
        return $this->_fileContents;
    }
}