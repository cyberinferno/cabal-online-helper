<?php

use cyberinferno\Cabal\Helpers\ItemOption;
use PHPUnit\Framework\TestCase;

/**
 * @covers \cyberinferno\Cabal\Helpers\ItemOption
 */
class ItemOptionTest extends TestCase
{
    public function testIsThereAnySyntaxError()
    {
        $myClass = new ItemOption(1);
        $this->assertTrue(is_object($myClass));
        unset($myClass);
    }

    public function testGetSlots()
    {
        $myClass = new ItemOption(1);
        $result = $myClass->getSlots();
        $this->assertEquals(1, $result);
    }

    public function testMinSlots()
    {
        $myClass = new ItemOption(-1);
        $result = $myClass->getSlots();
        $this->assertEquals(0, $result);
    }

    public function testMaxSlots()
    {
        $myClass = new ItemOption(5);
        $result = $myClass->getSlots();
        $this->assertEquals(4, $result);
    }

    public function testGetCrafts()
    {
        $myClass = new ItemOption(1, 1);
        $result = $myClass->getCrafts();
        $this->assertEquals(1, $result);
    }

    public function testMinCrafts()
    {
        $myClass = new ItemOption(1, -1);
        $result = $myClass->getCrafts();
        $this->assertEquals(0, $result);
    }

    public function testMaxCrafts()
    {
        $myClass = new ItemOption(1, 4);
        $result = $myClass->getCrafts();
        $this->assertEquals(3, $result);
    }

    /**
     * @expectedException \cyberinferno\Cabal\Helpers\Exceptions\MaxOptionException
     */
    public function testMaxOptionExceptionIsThrownWhenMaxOptionReached()
    {
        $myClass = new ItemOption(4, 3);
        unset($myClass);
    }

    public function testGetSlotOptions()
    {
        $myClass = new ItemOption(1);
        $result = $myClass->getSlotOptions();
        $this->assertTrue(is_array($result));
        $this->assertEquals(0, count($result));
    }

    public function testSetSlotOption()
    {
        $myClass = new ItemOption(1);
        $result = $myClass->setSlotOption(1);
        $this->assertTrue($result instanceof ItemOption);
        $this->assertEquals(1, count($myClass->getSlotOptions()));
    }

    /**
     * @expectedException \cyberinferno\Cabal\Helpers\Exceptions\InvalidOptionException
     */
    public function testIfInvalidOptionExceptionIsThrownInSetSlotOption()
    {
        $myClass = new ItemOption(1);
        $myClass->setSlotOption(0);
    }

    /**
     * @expectedException \cyberinferno\Cabal\Helpers\Exceptions\OptionLimitException
     */
    public function testIfOptionLimitExceptionIsThrownInSetSlotOption()
    {
        $myClass = new ItemOption(1);
        $myClass->setSlotOption(1);
        $myClass->setSlotOption(1);
    }

    public function testGetCraftOptions()
    {
        $myClass = new ItemOption(1, 1);
        $result = $myClass->getCraftOptions();
        $this->assertTrue(is_array($result));
        $this->assertEquals(0, count($result));
    }

    public function testSetCraftOption()
    {
        $myClass = new ItemOption(1, 1);
        $result = $myClass->setCraftOption(9, 1);
        $this->assertTrue($result instanceof ItemOption);
        $this->assertEquals(1, count($myClass->getCraftOptions()));
    }

    /**
     * @expectedException \cyberinferno\Cabal\Helpers\Exceptions\InvalidCraftLevelException
     */
    public function testIfInvalidCraftLevelExceptionIsThrownInSetCraftOption()
    {
        $myClass = new ItemOption(1, 1);
        $myClass->setCraftOption(1, 1);
    }

    /**
     * @expectedException \cyberinferno\Cabal\Helpers\Exceptions\InvalidOptionException
     */
    public function testIfInvalidOptionExceptionIsThrownInSetCraftOption()
    {
        $myClass = new ItemOption(1, 1);
        $myClass->setCraftOption(9, 0);
    }

    /**
     * @expectedException \cyberinferno\Cabal\Helpers\Exceptions\OptionLimitException
     */
    public function testIfOptionLimitExceptionIsThrownInSetCraftOption()
    {
        $myClass = new ItemOption(1, 1);
        $result = $myClass->setCraftOption(9, 1);
        $result = $myClass->setCraftOption(9, 1);
    }

    public function testGenerate()
    {
        // A 3 slotted item
        $myClass = new ItemOption(3);
        // 2 slot sword amp
        $myClass->setSlotOption(8)->setSlotOption(8);
        // 1 slot Max crit/HP steal
        $myClass->setSlotOption('C');
        $this->assertEquals(hexdec('30001C28'), $myClass->generate());

        // A 4 slotted item
        $myClass = new ItemOption(4);
        // 2 slot sword amp
        $myClass->setSlotOption(8)->setSlotOption(8);
        // 2 slots Max crit/HP steal
        $myClass->setSlotOption('C')->setSlotOption('C');
        $this->assertEquals('40002C28', $myClass->generate(ItemOption::OUTPUT_FORMAT_HEXADECIMAL));

        // A 4 slotted item
        $myClass = new ItemOption(4);
        // 1 slot Max crit/HP steal
        $myClass->setSlotOption('C');
        // 1 sword amp
        $myClass->setSlotOption(8);
        // 1 HP/DEF
        $myClass->setSlotOption(1);
        // 1 DEF/ATT RATE
        $myClass->setSlotOption(2);
        $this->assertEquals('4211181C', $myClass->generate(ItemOption::OUTPUT_FORMAT_HEXADECIMAL));

        // A 3 slotted item with 1 craft option
        $myClass = new ItemOption(3, 1);
        // All skill amp with max craft
        $myClass->setCraftOption('F', 'F');
        $this->assertEquals('300000FF', $myClass->generate(ItemOption::OUTPUT_FORMAT_HEXADECIMAL));

        // A 0 option item
        $myClass = new ItemOption();
        $this->assertEquals('00000000', $myClass->generate(ItemOption::OUTPUT_FORMAT_HEXADECIMAL));

        // A 1 craft item
        $myClass = new ItemOption(0, 1);
        // All skill amp with max craft
        $myClass->setCraftOption('F', 'F');
        $this->assertEquals('000000FF', $myClass->generate(ItemOption::OUTPUT_FORMAT_HEXADECIMAL));

        // A 4 slotted item
        $myClass = new ItemOption(4);
        // 4 slot sword amp which shouldn't work
        $myClass->setSlotOption(8)->setSlotOption(8)->setSlotOption(8)->setSlotOption(8);
        $this->assertEquals('40000038', $myClass->generate(ItemOption::OUTPUT_FORMAT_HEXADECIMAL));
    }

    public function testExtract()
    {
        $result = ItemOption::extract('300038ff');
        $this->assertTrue(is_array($result));
        $this->assertTrue(array_key_exists('slots', $result));
        $this->assertEquals(3, $result['slots']);
        $this->assertTrue(array_key_exists('crafts', $result));
        $this->assertEquals(1, $result['crafts']);
        $this->assertTrue(array_key_exists('slotOptions', $result));
        $this->assertEquals(3, count($result['slotOptions']));
        $this->assertTrue(array_key_exists('craftOptions', $result));
        $this->assertEquals(1, count($result['craftOptions']));

        $result = ItemOption::extract(255);
        $this->assertTrue(is_array($result));
        $this->assertTrue(array_key_exists('slots', $result));
        $this->assertEquals(0, $result['slots']);
        $this->assertTrue(array_key_exists('crafts', $result));
        $this->assertEquals(1, $result['crafts']);
        $this->assertTrue(array_key_exists('slotOptions', $result));
        $this->assertEquals(0, count($result['slotOptions']));
        $this->assertTrue(array_key_exists('craftOptions', $result));
        $this->assertEquals(1, count($result['craftOptions']));
    }
}