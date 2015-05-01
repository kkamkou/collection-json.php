<?php

use \CollectionJson;

class QueryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorExceptions()
    {
        try { new CollectionJson\Property\Link(); } catch (Exception $expected) { return; }
        try { new CollectionJson\Property\Link('smth'); } catch (Exception $expected) { return; }
        $this->fail();
    }

    public function testConstructor()
    {
        $data = new \CollectionJson\Property\Data('testField', 'value', 'Test Field');

        $obj = new CollectionJson\Property\Query('href', 'rel', 'name', 'prompt', array($data, $data));
        foreach (array('href', 'rel', 'name', 'prompt') as $field) {
            $this->assertEquals($obj->{'get' . ucfirst($field)}(), $field);
        }

        $this->assertCount(2, $obj->getData());
    }

    public function testToArrayWithoutNulls()
    {
        $data = new \CollectionJson\Property\Data('testField', 'value', 'Test Field');
        $obj = new CollectionJson\Property\Query(
            'http://example.com/search', 'search', 'Search', 'Search page', array($data)
        );

        $result = $obj->toArray();
        foreach (array('href', 'rel', 'name', 'data', 'prompt') as $key) {
            $this->assertArrayHasKey($key, $result);
        }
    }

    public function testToArrayWithNulls()
    {
        $obj = new CollectionJson\Property\Query('http://example.com', 'homepage');
        $result = $obj->toArray();
        foreach (array('name', 'data', 'prompt') as $key) {
            $this->assertFalse(array_key_exists($key, $result));
        }
    }
}
