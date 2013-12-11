Collection+JSON
===================

PHP implementation of the Collection+JSON [specification](http://amundsen.com/media-types/collection/format/)

Examples of media type in use [can be found here](http://amundsen.com/media-types/collection/examples/).

## Example
```
use \CollectionJson\Collection;
use \CollectionJson\Property;

$data = new Property\Data('firstName', 'Duck', 'Full name');
$link = new Property\Link('http://example.com', 'homepage', 'Homepage', 'link', 'Link to the homepage');

$item = new Collection\Item('http://example.com/item');
$item->addData($data)->addLink($link);

$collection = new Collection('http://example.com');
$collection->addItem($item);

echo $collection;
```

## Tests
```
phpcs --standard=psr2 CollectionJson
cd tests
phpunit ./
```


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/kkamkou/collection-json.php/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
