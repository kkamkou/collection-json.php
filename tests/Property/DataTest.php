<?php

use \CollectionJson;

class DataTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorExceptions()
    {
        try { new CollectionJson\Property\Data(); } catch (Exception $expected) { return; }
        $this->fail();
    }

    public function testConstructor()
    {
        $obj = new CollectionJson\Property\Data('name', 'value', 'prompt');
        foreach (array('name', 'value', 'prompt') as $field) {
            $this->assertEquals($obj->{'get' . ucfirst($field)}(), $field);
        }
    }

    public function testToArrayWithoutNulls()
    {
        $obj = new CollectionJson\Property\Data('fieldName', 'value', 'Test value');
        $result = $obj->toArray();
        foreach (array('name', 'value', 'prompt') as $key) {
            $this->assertArrayHasKey($key, $result);
        }
    }

    public function testToArrayWithNulls()
    {
        $obj = new CollectionJson\Property\Data('fieldName');
        $result = $obj->toArray();
        foreach (array('prompt') as $key) {
            $this->assertFalse(array_key_exists($key, $result));
        }
    }
}
