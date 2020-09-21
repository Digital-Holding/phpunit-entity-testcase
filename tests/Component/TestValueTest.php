<?php

declare(strict_types=1);

namespace DH\UnitTests\Component;

use PHPUnit\Framework\TestCase;

class TestValueTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testInitialization($inputValue, $expectedValue)
    {
        $testValue = new TestValue($inputValue, $expectedValue);

        $this->assertEquals($inputValue, $testValue->getInputValue());
        $this->assertEquals($expectedValue, $testValue->getExpectedValue());
    }

    public function provider()
    {
        return array(
          array("abc", "def"),
          array(0, null),
          array(null, 0),
          array("a", "a")
        );
    }
}
