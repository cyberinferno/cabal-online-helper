<?php
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    /**
     * Just check if the CharacterTest has no syntax error
     *
     * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
     * any typo before you even use this library in a real project.
     *
     */
    public function testIsThereAnySyntaxError()
    {
        $var = new cyberinferno\Cabal\Helpers\Character();
        $this->assertTrue(is_object($var));
        unset($var);
    }
}