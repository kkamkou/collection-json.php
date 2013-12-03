<?php
require __DIR__ . '/../CollectionJson/Collection/Item.php';
require __DIR__ . '/../CollectionJson/Collection/AttrInterface.php';
require __DIR__ . '/../CollectionJson/Collection/Error.php';
require __DIR__ . '/../CollectionJson/Collection.php';

class CollectionTest extends PHPUnit_Framework_TestCase
{
    public function testEncode()
    {
        $item = new \CollectionJson\Collection\Item('http://example.com');
        $error = new \CollectionJson\Collection\Error('An error', '0x00000001', 'Blue Screen');

        $collection = new \CollectionJson\Collection();
        $collection->addItem($item)
            ->setError($error);

        echo (string)$collection;
    }
}
