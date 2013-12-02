<?php
require __DIR__ . '/../CollectionJson/Collection/Item.php';
require __DIR__ . '/../CollectionJson/Collection.php';

class CollectionTest extends PHPUnit_Framework_TestCase
{
    public function testEncode()
    {
        $item = new \CollectionJson\Collection\Item('http://example.com');

        $collection = new \CollectionJson\Collection();
        $collection->addItem($item);
    }
}
