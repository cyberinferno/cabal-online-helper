<?php

use cyberinferno\Cabal\Helpers\GameConstants;
use PHPUnit\Framework\TestCase;

class GameConstantsTest extends TestCase
{
    public function testIsThereAnySyntaxError()
    {
        $myClass = new GameConstants();
        $this->assertTrue(is_object($myClass));
        unset($myClass);
    }

    public function testListClasses()
    {
        $myClass = new GameConstants();
        $result = $myClass::listClasses();
        $this->assertTrue(is_array($result));
        $this->assertEquals(6, count($result));
    }

    public function testListNations()
    {
        $myClass = new GameConstants();
        $result = $myClass::listNations();
        $this->assertTrue(is_array($result));
        $this->assertEquals(4, count($result));
    }

    public function testListRanks()
    {
        $myClass = new GameConstants();
        $result = $myClass::listRanks();
        $this->assertTrue(is_array($result));
        $this->assertEquals(10, count($result));
    }

    public function testListAuras()
    {
        $myClass = new GameConstants();
        $result = $myClass::listAuras();
        $this->assertTrue(is_array($result));
        $this->assertEquals(7, count($result));
    }
}