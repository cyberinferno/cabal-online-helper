<?php

namespace cyberinferno\Cabal\Helpers\FileSystem\Client;

use cyberinferno\Cabal\Helpers\Exceptions\FileBadFormatException;
use cyberinferno\Cabal\Helpers\FileSystem\File;

/**
 * Class CabalMsg
 *
 * Helper class to load contents from cabal_msg.dec file
 *
 * @package cyberinferno\Cabal\Helpers\FileSystem\Client
 * @author Karthik P
 */
class CabalMsg extends File
{
    /**
     * @var \SimpleXMLElement
     */
    protected $_xmlObject;

    /**
     * Returns the XML object of the specified cabal_msg.dec file
     *
     * @return \SimpleXMLElement
     */
    public function getXmlObject()
    {
        if (isset($this->_xmlObject) === false) {
            libxml_use_internal_errors(true);
            $domDocument = new \DOMDocument();
            $domDocument->recover = true;
            $domDocument->loadXML($this->getFileContents());
            $this->_xmlObject = simplexml_load_string($domDocument->saveXML());
        }
        return $this->_xmlObject;
    }

    /**
     * Returns array representation of attributes of the XML tree node attribute
     * If $topLevelKey is sent only that node's attributes are returned
     *
     * WARNING: This method might take lot of time to complete when XML tree is large
     *
     * @param string $topLevelKey
     * @return array
     */
    public function getArray($topLevelKey = '')
    {
        $xmlObject = $this->getXmlObject();
        if (!empty($topLevelKey)) {
            return get_object_vars($xmlObject->$topLevelKey);
        }
        return get_object_vars($xmlObject);
    }

    /**
     * @inheritdoc
     */
    protected function validateFormat()
    {
        parent::validateFormat();
        $fileContents = $this->getFileContents();
        if (substr($fileContents, 0, strlen('<cabal_message>')) !== '<cabal_message>') {
            throw new FileBadFormatException();
        }
    }
}