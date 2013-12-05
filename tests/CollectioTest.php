<?php
require __DIR__ . '/../CollectionJson/Interfaces/ArrayConvertible.php';
require __DIR__ . '/../CollectionJson/Property/Data.php';
require __DIR__ . '/../CollectionJson/Property/Link.php';
require __DIR__ . '/../CollectionJson/Collection/Error.php';
require __DIR__ . '/../CollectionJson/Collection/Item.php';
require __DIR__ . '/../CollectionJson/Collection/Template.php';
require __DIR__ . '/../CollectionJson/Collection.php';

use \CollectionJson\Collection;
use \CollectionJson\Collection\Template;
use \CollectionJson\Collection\Error;
use \CollectionJson\Collection\Item;
use \CollectionJson\Property\Data;
use \CollectionJson\Property\Link;

class CollectionTest extends PHPUnit_Framework_TestCase
{
    public function testTemplate()
    {
        $datas = array(
            new Data('firstName', 'PHPUnit', 'Full name'),
            new Data('age', 23, 'Ages')
        );

        $template = new Template($datas);

        $collection = new Collection('http://example.com');
        $collection->setTemplate($template);
    }

    public function testItems()
    {
        $data = new Data('firstName', 'PHPUnit', 'Full name');
        $link = new Link('http://example.com', 'something', 'Strange link', 'link', 'Some link');

        $item = new Item('http://example.com/item');
        $item->addData($data)->addData($data);
        $item->addLink($link)->addLink($link);

        $collection = new Collection('http://example.com');
        $collection->addItem($item);

        echo $collection;
    }

    public function testError()
    {
        $error = new Error('An error', '0x00000001', 'Blue Screen');
        $collection = new Collection('http://example.com');
        $collection->setError($error);
        $output = json_decode($collection, true);
        $this->assertEquals($output['collection']['error'], $error->__toArray());

        $collection->setError(new Error('An error'));
        $output = json_decode($collection, true);
        $this->assertEquals($output['collection']['error'], array('title' => 'An error'));
    }
}
