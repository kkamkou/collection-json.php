<?php

use \CollectionJson\Collection;
use \CollectionJson\Property;

class CollectionTest extends PHPUnit_Framework_TestCase
{
    public function testFixtureMinimal()
    {
        $collection = new Collection('http://example.org/friends/');
        $this->compareWithFixture($collection, 'minimal');
    }

    public function testFixtureError()
    {
        $collection = new Collection('http://example.org/friends/');
        $collection->setError(
            new Collection\Error(
                'Server Error', 'X1C2', 'The server have encountered an error, please wait and try again.'
            )
        );
        $this->compareWithFixture($collection, 'error');
    }

    public function testFixtureWrite()
    {
        $datas = array(
            new Property\Data('full-name', 'W. Chandry'),
            new Property\Data('email', 'wchandry@example.org'),
            new Property\Data('blog', 'http://example.org/blogs/wchandry'),
            new Property\Data('avatar', 'http://example.org/images/wchandry'),
        );

        $collection = new Collection\Template($datas);

        $this->compareWithFixture($collection, 'write');
    }

    public function testFixtureTemplate()
    {
        $datas = array(
            new Property\Data('full-name', '', 'Full Name'),
            new Property\Data('email', '', 'Email'),
            new Property\Data('blog', '', 'Blog'),
            new Property\Data('avatar', '', 'Avatar'),
        );

        $collection = new Collection('http://example.org/friends/');
        $collection->setTemplate(new Collection\Template($datas));

        $this->compareWithFixture($collection, 'template');
    }

    public function testFixtureQueries()
    {
        $query = new Property\Query('http://example.org/friends/search', 'search', null, 'Search');
        $query->addData(new Property\Data('search'));

        $collection = new Collection('http://example.org/friends/');
        $collection->addQuery($query);

        $this->compareWithFixture($collection, 'queries');
    }

    public function testFixtureItem()
    {
        $links = array(
            new Property\Link('http://example.org/friends/rss', 'feed'),
            new Property\Link('http://example.org/friends/?queries', 'queries'),
            new Property\Link('http://example.org/friends/?template', 'template')
        );

        $item = new Collection\Item('http://example.org/friends/jdoe');
        $item->addDataSet(array(
            new Property\Data('full-name', 'J. Doe', 'Full Name'),
            new Property\Data('email', 'jdoe@example.org', 'Email')
        ));
        $item->addLinkSet(array(
            new Property\Link('http://examples.org/blogs/jdoe', 'blog', null, null, 'Blog'),
            new Property\Link('http://examples.org/images/jdoe', 'avatar', null, 'image', 'Avatar'),
        ));

        $collection = new Collection('http://example.org/friends/');
        $collection->addLinkSet($links)
            ->addItem($item);

        $this->compareWithFixture($collection, 'item');
    }

    public function testFixtureCollection()
    {
        $query = new Property\Query('http://example.org/friends/search', 'search', null, 'Search');
        $query->addData(new Property\Data('search'));

        $tplDatas = array(
            new Property\Data('full-name', '', 'Full Name'),
            new Property\Data('email', '', 'Email'),
            new Property\Data('blog', '', 'Blog'),
            new Property\Data('avatar', '', 'Avatar'),
        );

        $items = array(
            new Collection\Item('http://example.org/friends/jdoe'),
            new Collection\Item('http://example.org/friends/msmith'),
            new Collection\Item('http://example.org/friends/rwilliams')
        );

        $items[0]->addDataSet(array(
            new Property\Data('full-name', 'J. Doe', 'Full Name'),
            new Property\Data('email', 'jdoe@example.org', 'Email')
        ));
        $items[0]->addLinkSet(array(
            new Property\Link('http://examples.org/blogs/jdoe', 'blog', null, null, 'Blog'),
            new Property\Link('http://examples.org/images/jdoe', 'avatar', null, 'image', 'Avatar')
        ));

        $items[1]->addDataSet(array(
            new Property\Data('full-name', 'M. Smith', 'Full Name'),
            new Property\Data('email', 'msmith@example.org', 'Email')
        ));
        $items[1]->addLinkSet(array(
            new Property\Link('http://examples.org/blogs/msmith', 'blog', null, null, 'Blog'),
            new Property\Link('http://examples.org/images/msmith', 'avatar', null, 'image', 'Avatar')
        ));

        $items[2]->addDataSet(array(
            new Property\Data('full-name', 'R. Williams', 'Full Name'),
            new Property\Data('email', 'rwilliams@example.org', 'Email')
        ));
        $items[2]->addLinkSet(array(
            new Property\Link('http://examples.org/blogs/rwilliams', 'blog', null, null, 'Blog'),
            new Property\Link('http://examples.org/images/rwilliams', 'avatar', null, 'image', 'Avatar')
        ));

        $collection = new Collection('http://example.org/friends/');
        $collection->addQuery($query)
            ->setTemplate(new Collection\Template($tplDatas))
            ->addItemSet($items)
            ->addLink(
                new Property\Link('http://example.org/friends/rss', 'feed')
            );

        $this->compareWithFixture($collection, 'collection');
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

    protected function compareWithFixture($mixed, $name)
    {
        $json = file_get_contents(__DIR__ . "/_fixtures/{$name}.json");
        $json = json_decode($json, true);
        $this->assertEquals($json, $mixed->__toArray());
    }
}
