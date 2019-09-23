<?php

use cyberinferno\Cabal\Helpers\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testIsThereAnySyntaxError()
    {
        $myClass = new Item(1);
        $this->assertTrue(is_object($myClass));
        unset($myClass);
    }

    public function testGetItemCode()
    {
        $myClass = new Item(1);
        $result = $myClass->getItemCode();
        $this->assertEquals(1, $result);
    }

    public function testGetGrade()
    {
        $myClass = new Item(1);
        $result = $myClass->getGrade();
        $this->assertEquals(0, $result);
    }

    public function testSetGrade()
    {
        $myClass = new Item(1);
        $result = $myClass->setGrade(3);
        $this->assertTrue($result instanceof Item);
        $this->assertEquals(3, $myClass->getGrade());
    }

    public function testSetGradeBelowMinimum()
    {
        $myClass = new Item(1);
        $result = $myClass->setGrade(-1);
        $this->assertTrue($result instanceof Item);
        $this->assertEquals(0, $myClass->getGrade());
    }

    public function testSetGradeAboveMaximum()
    {
        $myClass = new Item(1);
        $result = $myClass->setGrade(16);
        $this->assertTrue($result instanceof Item);
        $this->assertEquals(15, $myClass->getGrade());
    }

    public function testGetBinding()
    {
        $myClass = new Item(1);
        $result = $myClass->getBinding();
        $this->assertEquals(0, $result);
    }

    public function testSetAccountBinding()
    {
        $myClass = new Item(1);
        $result = $myClass->setAccountBinding();
        $this->assertTrue($result instanceof Item);
        $this->assertEquals(Item::ITEM_BIND_ACCOUNT_CONSTANT, $myClass->getBinding());
    }

    public function testSetCharacterBinding()
    {
        $myClass = new Item(1);
        $result = $myClass->setCharacterBinding();
        $this->assertTrue($result instanceof Item);
        $this->assertEquals(Item::ITEM_BIND_CHARACTER_CONSTANT, $myClass->getBinding());
    }

    public function testSetCharacterBindingOnUsage()
    {
        $myClass = new Item(1);
        $result = $myClass->setCharacterBindingOnUsage();
        $this->assertTrue($result instanceof Item);
        $this->assertEquals(Item::ITEM_BIND_CHARACTER_ON_USAGE_CONSTANT, $myClass->getBinding());
    }

    public function testGenerateItemCode()
    {
        $myClass = new Item(1);
        $result = $myClass->setCharacterBindingOnUsage()->setGrade(3)->generateItemCode();
        $this->assertEquals(
            1 + Item::ITEM_BIND_CHARACTER_ON_USAGE_CONSTANT + 3 * Item::ITEM_GRADE_CONSTANT,
            $result
        );
    }
}