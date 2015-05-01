<?php

use \CollectionJson;

class ErrorTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $obj = new CollectionJson\Collection\Error('title', 'code', 'message');
        foreach (array('title', 'code', 'message') as $field) {
            $this->assertEquals($obj->{'get' . ucfirst($field)}(), $field);
        }
    }

    public function testToArrayWithoutNulls()
    {
        $obj = new CollectionJson\Collection\Error('not found', 404, 'Example message');
        $result = $obj->toArray();
        foreach (array('code', 'message', 'title') as $key) {
            $this->assertArrayHasKey($key, $result);
            $this->assertTrue(is_string($result[$key]));
        }
    }

    public function testToArrayWithNulls()
    {
        $obj = new CollectionJson\Property\Data('fieldName');
        $result = $obj->toArray();
        foreach (array('code', 'message') as $key) {
            $this->assertFalse(array_key_exists($key, $result));
        }
    }
}
