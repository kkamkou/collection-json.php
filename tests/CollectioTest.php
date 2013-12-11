<?php

use \CollectionJson\Collection;
use \CollectionJson\Property;

class CollectionTest extends PHPUnit_Framework_TestCase
{
    public function testTemplate()
    {
        $datas = array(
            new Property\Data('firstName', 'PHPUnit', 'Full name'),
            new Property\Data('age', 23, 'Ages')
        );

        $template = new Collection\Template($datas);

        $collection = new Collection('http://example.com');
        $collection->setTemplate($template);
    }

    public function testItems()
    {
        $data = new Property\Data('firstName', 'PHPUnit', 'Full name');
        $link = new Property\Link('http://example.com', 'something', 'Strange link', 'link', 'Some link');

        $item = new Collection\Item('http://example.com/item');
        $item->addData($data)->addData($data);
        $item->addLink($link)->addLink($link);

        $collection = new Collection('http://example.com');
        $collection->addItem($item);

    }

    public function testError()
    {
        $error = new Collection\Error('An error', '0x00000001', 'Blue Screen');
        $collection = new Collection('http://example.com');
        $collection->setError($error);
        $output = json_decode($collection, true);
        $this->assertEquals($output['collection']['error'], $error->__toArray());

        $collection->setError(new Collection\Error('An error'));
        $output = json_decode($collection, true);
        $this->assertEquals($output['collection']['error'], array('title' => 'An error'));
    }
}
