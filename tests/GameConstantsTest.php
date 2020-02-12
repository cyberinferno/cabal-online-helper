<?php

use cyberinferno\Cabal\Helpers\GameConstants;
use PHPUnit\Framework\TestCase;

/**
 * @covers \cyberinferno\Cabal\Helpers\GameConstants
 */
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

    public function testListItemDurations()
    {
        $myClass = new GameConstants();
        $result = $myClass::listItemDurations();
        $this->assertTrue(is_array($result));
        $this->assertEquals(27, count($result));
    }

    public function testListBindings()
    {
        $myClass = new GameConstants();
        $result = $myClass::listBindings();
        $this->assertTrue(is_array($result));
        $this->assertEquals(4, count($result));
    }

    public function testListDungeons()
    {
        $myClass = new GameConstants();
        $result = $myClass::listDungeons();
        $this->assertTrue(is_array($result));
        $this->assertEquals(65, count($result));
    }
}