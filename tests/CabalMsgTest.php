<?php

use cyberinferno\Cabal\Helpers\FileSystem\Client\CabalMsg;
use PHPUnit\Framework\TestCase;

class CabalMsgTest extends TestCase
{
    public $fileSystem;

    public function setUp()
    {
        $directory = [
            'client' => [
                'cabal_msg.dec' => '<cabal_message><version index="3" /></cabal_message>',
                'cabal_msg_invalid.dec' => '<cabal_message'
            ]
        ];
        $this->fileSystem = \org\bovigo\vfs\vfsStream::setup('root', 444, $directory);
    }

    public function testIsThereAnySyntaxError()
    {
        $myClass = new CabalMsg($this->fileSystem->url() . '/client/cabal_msg.dec');
        $this->assertTrue(is_object($myClass));
        unset($myClass);
    }

    /**
     * @expectedException \cyberinferno\Cabal\Helpers\Exceptions\FileNotFoundException
     */
    public function testFileNotFoundExceptionIsThrownWhenNoFile()
    {
        $myClass = new CabalMsg(
            $this->fileSystem->url() . '/unknown.dec'
        );
        unset($myClass);
    }

    /**
     * @expectedException \cyberinferno\Cabal\Helpers\Exceptions\FileBadFormatException
     */
    public function testFileBadFormatExceptionIsThrownWhenNoFile()
    {
        $myClass = new CabalMsg(
            $this->fileSystem->url() . '/client/cabal_msg_invalid.dec'
        );
        unset($myClass);
    }

    public function testGetXmlObject()
    {
        $myClass = new CabalMsg(
            $this->fileSystem->url() . '/client/cabal_msg.dec'
        );
        $result = $myClass->getXmlObject();
        $this->assertTrue($result instanceof \SimpleXMLElement);
    }

    public function testGetArray()
    {
        $myClass = new CabalMsg(
            $this->fileSystem->url() . '/client/cabal_msg.dec'
        );
        $result = $myClass->getArray();
        $this->assertTrue(is_array($result));
        $result = $myClass->getArray('version');
        $this->assertTrue(!empty($result));
    }
}