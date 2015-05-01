<?php

use \CollectionJson;

class LinkTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorExceptions()
    {
        try { new CollectionJson\Property\Link(); } catch (Exception $expected) { return; }
        try { new CollectionJson\Property\Link('smth'); } catch (Exception $expected) { return; }
        $this->fail();
    }

    public function testConstructor()
    {
        $obj = new CollectionJson\Property\Link('href', 'rel', 'name', 'image', 'prompt');
        foreach (array('href', 'rel', 'name', 'prompt') as $field) {
            $this->assertEquals($obj->{'get' . ucfirst($field)}(), $field);
        }
        $this->assertEquals($obj->getRender(), 'image');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRenderFieldInvalid()
    {
        $obj = new CollectionJson\Property\Link('href', 'rel');
        $obj->setRender('wrong');
    }

    public function testRenderFieldValid()
    {
        $obj = new CollectionJson\Property\Link('href', 'rel');
        foreach (array('link', 'image', null) as $val) {
            $this->assertEquals($obj->setRender($val)->getRender(), $val);
        }
    }

    public function testToArrayWithoutNulls()
    {
        $obj = new CollectionJson\Property\Link(
            'http://example.com', 'homepage', 'My Homepage', 'link', 'Link to the homepage'
        );
        $result = $obj->toArray();
        foreach (array('href', 'rel', 'name', 'render', 'prompt') as $key) {
            $this->assertArrayHasKey($key, $result);
        }
    }

    public function testToArrayWithNulls()
    {
        $obj = new CollectionJson\Property\Link('http://example.com', 'homepage');
        $result = $obj->toArray();
        foreach (array('name', 'render', 'prompt') as $key) {
            $this->assertFalse(array_key_exists($key, $result));
        }
    }
}
