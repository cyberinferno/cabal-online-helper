<?php

use cyberinferno\Cabal\Helpers\ItemCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \cyberinferno\Cabal\Helpers\ItemCode
 */
class ItemCodeTest extends TestCase
{
    public function testIsThereAnySyntaxError()
    {
        $myClass = new ItemCode(1);
        $this->assertTrue(is_object($myClass));
        unset($myClass);
    }

    public function testGetItemCode()
    {
        $myClass = new ItemCode(1);
        $result = $myClass->getItemCode();
        $this->assertEquals(1, $result);
    }

    public function testGetGrade()
    {
        $myClass = new ItemCode(1);
        $result = $myClass->getGrade();
        $this->assertEquals(0, $result);
    }

    public function testSetGrade()
    {
        $myClass = new ItemCode(1);
        $result = $myClass->setGrade(3);
        $this->assertTrue($result instanceof ItemCode);
        $this->assertEquals(3, $myClass->getGrade());
    }

    public function testSetGradeBelowMinimum()
    {
        $myClass = new ItemCode(1);
        $result = $myClass->setGrade(-1);
        $this->assertTrue($result instanceof ItemCode);
        $this->assertEquals(0, $myClass->getGrade());
    }

    public function testSetGradeAboveMaximum()
    {
        $myClass = new ItemCode(1);
        $result = $myClass->setGrade(21);
        $this->assertTrue($result instanceof ItemCode);
        $this->assertEquals(20, $myClass->getGrade());
    }

    public function testGetBinding()
    {
        $myClass = new ItemCode(1);
        $result = $myClass->getBinding();
        $this->assertEquals(0, $result);
    }

    public function testSetAccountBinding()
    {
        $myClass = new ItemCode(1);
        $result = $myClass->setAccountBinding();
        $this->assertTrue($result instanceof ItemCode);
        $this->assertEquals(ItemCode::ITEM_BIND_ACCOUNT_CONSTANT, $myClass->getBinding());
    }

    public function testSetCharacterBinding()
    {
        $myClass = new ItemCode(1);
        $result = $myClass->setCharacterBinding();
        $this->assertTrue($result instanceof ItemCode);
        $this->assertEquals(ItemCode::ITEM_BIND_CHARACTER_CONSTANT, $myClass->getBinding());
    }

    public function testSetCharacterBindingOnUsage()
    {
        $myClass = new ItemCode(1);
        $result = $myClass->setCharacterBindingOnUsage();
        $this->assertTrue($result instanceof ItemCode);
        $this->assertEquals(ItemCode::ITEM_BIND_CHARACTER_ON_USAGE_CONSTANT, $myClass->getBinding());
    }

    public function testSetNoBinding()
    {
        $myClass = new ItemCode(1);
        $result = $myClass->setCharacterBindingOnUsage()->setNoBinding();
        $this->assertTrue($result instanceof ItemCode);
        $this->assertEquals(0, $myClass->getBinding());
    }

    public function testGenerate()
    {
        $myClass = new ItemCode(1);
        $result = $myClass->setCharacterBindingOnUsage()->setGrade(3)->generate();
        $this->assertEquals(
            1 + ItemCode::ITEM_BIND_CHARACTER_ON_USAGE_CONSTANT + 3 * ItemCode::ITEM_GRADE_CONSTANT,
            $result
        );
    }

    public function testExtract()
    {
        $result = ItemCode::extract(3213);
        $this->assertTrue(is_array($result));
        $this->assertTrue(array_key_exists('itemCode', $result));
        $this->assertEquals(3213, $result['itemCode']);
        $this->assertTrue(array_key_exists('binding', $result));
        $this->assertEquals(0, $result['binding']);
        $this->assertTrue(array_key_exists('grade', $result));
        $this->assertEquals(0, $result['grade']);

        $result = ItemCode::extract(
            (new ItemCode(1))
                ->setCharacterBindingOnUsage()
                ->setGrade(3)
                ->generate()
        );
        $this->assertTrue(is_array($result));
        $this->assertTrue(array_key_exists('itemCode', $result));
        $this->assertEquals(1, $result['itemCode']);
        $this->assertTrue(array_key_exists('binding', $result));
        $this->assertEquals(ItemCode::ITEM_BIND_CHARACTER_ON_USAGE_CONSTANT, $result['binding']);
        $this->assertTrue(array_key_exists('grade', $result));
        $this->assertEquals(3, $result['grade']);

        $result = ItemCode::extract(
            (new ItemCode(12))
                ->setCharacterBinding()
                ->setGrade(6)
                ->generate()
        );
        $this->assertTrue(is_array($result));
        $this->assertTrue(array_key_exists('itemCode', $result));
        $this->assertEquals(12, $result['itemCode']);
        $this->assertTrue(array_key_exists('binding', $result));
        $this->assertEquals(ItemCode::ITEM_BIND_CHARACTER_CONSTANT, $result['binding']);
        $this->assertTrue(array_key_exists('grade', $result));
        $this->assertEquals(6, $result['grade']);

        $result = ItemCode::extract(
            (new ItemCode(1253))
                ->setAccountBinding()
                ->setGrade(10)
                ->generate()
        );
        $this->assertTrue(is_array($result));
        $this->assertTrue(array_key_exists('itemCode', $result));
        $this->assertEquals(1253, $result['itemCode']);
        $this->assertTrue(array_key_exists('binding', $result));
        $this->assertEquals(ItemCode::ITEM_BIND_ACCOUNT_CONSTANT, $result['binding']);
        $this->assertTrue(array_key_exists('grade', $result));
        $this->assertEquals(10, $result['grade']);

        $result = ItemCode::extract(
            (new ItemCode(2897))
                ->setGrade(15)
                ->generate()
        );
        $this->assertTrue(is_array($result));
        $this->assertTrue(array_key_exists('itemCode', $result));
        $this->assertEquals(2897, $result['itemCode']);
        $this->assertTrue(array_key_exists('binding', $result));
        $this->assertEquals(0, $result['binding']);
        $this->assertTrue(array_key_exists('grade', $result));
        $this->assertEquals(15, $result['grade']);

        $result = ItemCode::extract(
            (new ItemCode(4095))
                ->setCharacterBinding()
                ->generate()
        );
        $this->assertTrue(is_array($result));
        $this->assertTrue(array_key_exists('itemCode', $result));
        $this->assertEquals(4095, $result['itemCode']);
        $this->assertTrue(array_key_exists('binding', $result));
        $this->assertEquals(ItemCode::ITEM_BIND_CHARACTER_CONSTANT, $result['binding']);
        $this->assertTrue(array_key_exists('grade', $result));
        $this->assertEquals(0, $result['grade']);
    }

    public function testRemoveBinding()
    {
        $result = ItemCode::extract(ItemCode::removeBinding(
            (new ItemCode(2897))
                ->setGrade(15)
                ->setCharacterBindingOnUsage()
                ->generate()
        ));
        $this->assertEquals(2897, $result['itemCode']);
        $this->assertEquals(0, $result['binding']);
        $this->assertEquals(15, $result['grade']);
        $result = ItemCode::extract(ItemCode::removeBinding(
            (new ItemCode(4095))
                ->setAccountBinding()
                ->generate()
        ));
        $this->assertEquals(4095, $result['itemCode']);
        $this->assertEquals(0, $result['binding']);
        $this->assertEquals(0, $result['grade']);
    }
}