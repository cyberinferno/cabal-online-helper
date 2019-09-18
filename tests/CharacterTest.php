<?php
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    public function testIsThereAnySyntaxError()
    {
        $myClass = new cyberinferno\Cabal\Helpers\Character();
        $this->assertTrue(is_object($myClass));
        unset($myClass);
    }

    public function testEncodeStyle()
    {
        $myClass = new cyberinferno\Cabal\Helpers\Character();
        $result = $myClass::EncodeStyle(2,12,4,0,1,20,5);
        $this->assertEquals(159908261, $result);
    }

    public function testDecodeStyle()
    {
        $myClass = new cyberinferno\Cabal\Helpers\Character();
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
        $myClass = new cyberinferno\Cabal\Helpers\Character();
        $result = $myClass::EncodePosition(24,18);
        $this->assertEquals(1572882, $result);
    }

    public function testDecodePosition()
    {
        $myClass = new cyberinferno\Cabal\Helpers\Character();
        $result = $myClass::DecodePosition(1572882);
        $this->assertArrayHasKey('x', $result);
        $this->assertArrayHasKey('y', $result);
        $this->assertEquals(24, $result['x']);
        $this->assertEquals(18, $result['y']);
    }
}