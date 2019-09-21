<?php

namespace cyberinferno\Cabal\Helpers\FileSystem\Server;

use cyberinferno\Cabal\Helpers\Exceptions\FileBadFormatException;
use cyberinferno\Cabal\Helpers\FileSystem\File;

/**
 * Class WorldDrop
 *
 * Helper class to load contents from World_drop.scp file
 *
 * @package cyberinferno\Cabal\Helpers\FileSystem\Server
 */
class WorldDrop extends File
{
    /**
     * Returns array representation of the World_dop.scp file
     *
     * @return array
     */
    public function getArray()
    {
        $fileContents = $this->getFileContents();
        return explode("\n", $fileContents);
    }

    /**
     * @inheritdoc
     */
    protected function validateFormat()
    {
        if (filesize($this->_filePath) == 0 || $this->getFileContents() === null) {
            throw new FileBadFormatException();
        }
        $fileContents = $this->getFileContents();
        if (substr($fileContents, 0, strlen('[WorldDrop]')) !== '[WorldDrop]') {
            throw new FileBadFormatException();
        }
    }
}