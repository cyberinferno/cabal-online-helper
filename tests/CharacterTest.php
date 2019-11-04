<?php

use cyberinferno\Cabal\Helpers\Character;
use PHPUnit\Framework\TestCase;

/**
 * @covers \cyberinferno\Cabal\Helpers\Character
 */
class CharacterTest extends TestCase
{
    public function testIsThereAnySyntaxError()
    {
        $myClass = new Character();
        $this->assertTrue(is_object($myClass));
        unset($myClass);
    }

    public function testEncodeStyle()
    {
        $myClass = new Character();
        $result = $myClass::EncodeStyle(2, 12, 4, 0, 1, 20, 5);
        $this->assertEquals(159908261, $result);
    }

    public function testDecodeStyle()
    {
        $myClass = new Character();
        $result = $myClass::DecodeStyle(159908261);
        $this->assertArrayHasKey('gender', $result);
        $this->assertArrayHasKey('aura', $result);
        $this->assertArrayHasKey('hair', $result);
        $this->assertArrayHasKey('hairColor', $result);
        $this->assertArrayHasKey('face', $result);
        $this->assertArrayHasKey('rank', $result);
        $this->assertArrayHasKey('class', $result);
        $this->assertEquals(2, $result['gender']);
        $this->assertEquals(12, $result['aura']);
        $this->assertEquals(4, $result['hair']);
        $this->assertEquals(0, $result['hairColor']);
        $this->assertEquals(1, $result['face']);
        $this->assertEquals(20, $result['rank']);
        $this->assertEquals(5, $result['class']);
    }

    public function testEncodePosition()
    {
        $myClass = new Character();
        $result = $myClass::EncodePosition(24, 18);
        $this->assertEquals(1572882, $result);
    }

    public function testDecodePosition()
    {
        $myClass = new Character();
        $result = $myClass::DecodePosition(1572882);
        $this->assertArrayHasKey('x', $result);
        $this->assertArrayHasKey('y', $result);
        $this->assertEquals(24, $result['x']);
        $this->assertEquals(18, $result['y']);
    }

    public function testDecodeBinaryItemList()
    {
        $myClass = new Character();
        $result = $myClass::DecodeBinaryItemList(
            '0x65E0190014000004FF3800300000000000F869000000000000000000000002000000000065E0190015000004FF3F0030040014EDEFCD'
        );
        $this->assertEquals(3, count($result));
        $this->assertArrayHasKey('itemCode', $result[0]);
        $this->assertArrayHasKey('itemOption', $result[0]);
        $this->assertArrayHasKey('itemInventorySlot', $result[0]);
        $this->assertEquals(1695845, $result[0]['itemCode']);
        $this->assertEquals(805320959, $result[0]['itemOption']);
        $this->assertEquals(1, $result[0]['itemInventorySlot']);
        $this->assertArrayHasKey('itemCode', $result[1]);
        $this->assertArrayHasKey('itemOption', $result[1]);
        $this->assertArrayHasKey('itemInventorySlot', $result[1]);
        $this->assertEquals(105, $result[1]['itemCode']);
        $this->assertEquals(0, $result[1]['itemOption']);
        $this->assertEquals(3, $result[1]['itemInventorySlot']);
        $this->assertArrayHasKey('itemCode', $result[2]);
        $this->assertArrayHasKey('itemOption', $result[2]);
        $this->assertArrayHasKey('itemInventorySlot', $result[2]);
        $this->assertEquals(1695845, $result[2]['itemCode']);
        $this->assertEquals(805322751, $result[2]['itemOption']);
        $this->assertEquals(5, $result[2]['itemInventorySlot']);

        $result = $myClass::DecodeBinaryItemList(
            '690000000000000000000000000000000000'
        );
        $this->assertArrayHasKey('itemCode', $result[0]);
        $this->assertArrayHasKey('itemOption', $result[0]);
        $this->assertArrayHasKey('itemInventorySlot', $result[0]);
        $this->assertEquals(105, $result[0]['itemCode']);
        $this->assertEquals(0, $result[0]['itemOption']);
        $this->assertEquals(1, $result[0]['itemInventorySlot']);
    }
}