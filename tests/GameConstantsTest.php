<?php

use PHPUnit\Framework\TestCase;

class GameConstantsTest extends TestCase
{
    public function testIsThereAnySyntaxError()
    {
        $myClass = new cyberinferno\Cabal\Helpers\GameConstants();
        $this->assertTrue(is_object($myClass));
        unset($myClass);
    }

    public function testListClasses()
    {
        $myClass = new cyberinferno\Cabal\Helpers\GameConstants();
        $result = $myClass::listClasses();
        $this->assertTrue(is_array($result));
        $this->assertEquals(6, count($result));
    }

    public function testListNations()
    {
        $myClass = new cyberinferno\Cabal\Helpers\GameConstants();
        $result = $myClass::listNations();
        $this->assertTrue(is_array($result));
        $this->assertEquals(4, count($result));
    }

    public function testListRanks()
    {
        $myClass = new cyberinferno\Cabal\Helpers\GameConstants();
        $result = $myClass::listRanks();
        $this->assertTrue(is_array($result));
        $this->assertEquals(10, count($result));
    }

    public function testListAuras()
    {
        $myClass = new cyberinferno\Cabal\Helpers\GameConstants();
        $result = $myClass::listAuras();
        $this->assertTrue(is_array($result));
        $this->assertEquals(6, count($result));
    }
}