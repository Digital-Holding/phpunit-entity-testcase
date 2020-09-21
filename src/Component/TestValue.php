<?php

declare(strict_types=1);

namespace DH\UnitTests\Component;

/**
 * Simple TestValue structure which holds input and expected values for a test
 * case.
 */
class TestValue
{
    /**
     * Value which is passed to the setter.
     *
     * @var mixed|null
     */
    protected $inputValue;

    /**
     * Value expected from the respective getter for the input passed via setter.
     *
     * @var mixed|null
     */
    protected $expectedValue;

    public function __construct($inputValue, $expectedValue)
    {
        $this->inputValue = $inputValue;
        $this->expectedValue = $expectedValue;
    }

    /**
     * Returns the previously set value which is passed to the setter during
     * runtime.
     *
     * @return mixed|null
     */
    public function getInputValue()
    {
        return $this->inputValue;
    }

    /**
     * Returns the previously set value which is expected to be returned by the
     * getter during runtime.
     *
     * @return mixed|null
     */
    public function getExpectedValue()
    {
        return $this->expectedValue;
    }
}
