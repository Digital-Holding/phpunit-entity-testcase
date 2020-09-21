<?php

declare(strict_types=1);

namespace DH\UnitTests\Component;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Tests\DH\ArtisProductUnitsPlugin\Component\TestValue;

/**
 * A test case base class for entities or models.
 */
abstract class EntityTestcase extends TestCase
{
    /** @var PropertyAccessor */
    protected $propertyAccessor;

    /**
     * Gets the array of test values for class properties.
     *
     * @var TestValue[][string]
     */
    abstract protected function getDataProvider() : array;

    /**
     * Gets the class name for the current tests' set.
     */
    abstract protected function getContextClass() : string;

    /**
     * {@inheritdoc}
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $className = $this->getContextClass();
        if (!class_exists($className)) {
            throw new InvalidArgumentException(sprintf('Class \'%s\' does not exist.', $className));
        }

        $reflection = new ReflectionClass($className);
        $this->propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()
                                ->enableExceptionOnInvalidIndex()
                                ->getPropertyAccessor();
    }

    /**
     * Tests getters and setters based on the data provider.
     */
    public function testProperties()
    {
        $className = $this->getContextClass();
        $entity = new $className;
        $testData = $this->getDataProvider();
        if (empty($testData)) {
            trigger_error(sprintf('No tests for \'%s\'.', $className), E_USER_WARNING);
            return;
        }

        foreach ($testData as $property => $data) {
            /** @var TestValue */
            foreach ($data as $testValue) {
                $this->propertyAccessor->setValue($entity, $property, $testValue->getInputValue());
                $valueGet = $this->propertyAccessor->getValue($entity, $property);
                $this->assertEquals($testValue->getExpectedValue(), $valueGet);
            }
        }
    }
}
