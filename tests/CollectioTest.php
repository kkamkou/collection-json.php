<?php
require __DIR__ . '/../CollectionJson/Interfaces/ArrayConvertible.php';
require __DIR__ . '/../CollectionJson/Property/Data.php';
require __DIR__ . '/../CollectionJson/Collection/Error.php';
require __DIR__ . '/../CollectionJson/Collection/Item.php';
require __DIR__ . '/../CollectionJson/Collection/Template.php';
require __DIR__ . '/../CollectionJson/Collection.php';

use \CollectionJson\Collection;
use \CollectionJson\Collection\Template;
use \CollectionJson\Collection\Error;
use \CollectionJson\Property\Data;

class CollectionTest extends PHPUnit_Framework_TestCase
{
    public function testTemplate()
    {
        $datas = array(
            new Data('firstName', 'PHPUnit', 'Full name'),
            new Data('age', 23, 'Ages')
        );

        $template = new Template($datas);

        $collection = new Collection();
        $collection->setTemplate($template);

        echo $collection;
    }

    public function testError()
    {
        $error = new Error('An error', '0x00000001', 'Blue Screen');
        $collection = new Collection();
        $collection->setError($error);
        $output = json_decode($collection, true);
        $this->assertEquals($output['collection']['error'], $error->__toArray());

        $collection->setError(new Error('An error'));
        $output = json_decode($collection, true);
        $this->assertEquals($output['collection']['error'], array('title' => 'An error'));
    }
}
