<?php

class WorldDropTest extends \PHPUnit\Framework\TestCase
{
    public $fileSystem;

    public function setUp()
    {
        $directory = [
            'server' => [
                'World_drop.scp' => '[WorldDrop]',
                'World_drop_invalid.scp' => '[World'
            ]
        ];
        $this->fileSystem = \org\bovigo\vfs\vfsStream::setup('root', 444, $directory);
    }

    public function testIsThereAnySyntaxError()
    {
        $myClass = new \cyberinferno\Cabal\Helpers\FileSystem\Server\WorldDrop($this->fileSystem->url() . '/server/World_drop.scp');
        $this->assertTrue(is_object($myClass));
        unset($myClass);
    }

    /**
     * @expectedException \cyberinferno\Cabal\Helpers\Exceptions\FileNotFoundException
     */
    public function testFileNotFoundExceptionIsThrownWhenNoFile()
    {
        $myClass = new \cyberinferno\Cabal\Helpers\FileSystem\Server\WorldDrop(
            $this->fileSystem->url() . '/unknown.dec'
        );
        unset($myClass);
    }

    /**
     * @expectedException \cyberinferno\Cabal\Helpers\Exceptions\FileBadFormatException
     */
    public function testFileBadFormatExceptionIsThrownWhenNoFile()
    {
        $myClass = new \cyberinferno\Cabal\Helpers\FileSystem\Server\WorldDrop(
            $this->fileSystem->url() . '/server/World_drop_invalid.scp'
        );
        unset($myClass);
    }

    public function testGetArray()
    {
        $myClass = new \cyberinferno\Cabal\Helpers\FileSystem\Server\WorldDrop(
            $this->fileSystem->url() . '/server/World_drop.scp'
        );
        $result = $myClass->getArray();
        $this->assertTrue(is_array($result));
    }
}