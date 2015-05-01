Collection+JSON
===================

![Build Status](https://travis-ci.org/kkamkou/collection-json.php.svg?branch=master)

PHP implementation of the Collection+JSON [specification](http://amundsen.com/media-types/collection/format/)

Examples of media type in use [can be found here](http://amundsen.com/media-types/collection/examples/).

## Example
More examples are located in the ```CollectioTest.php``` test file

```php
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

## Docker
```sh
[sudo] docker build .
[sudo] docker run -v "`pwd`":/opt/collection-json.php IMAGE_ID phpcs --standard=psr2 CollectionJson
[sudo] docker run -v "`pwd`":/opt/collection-json.php IMAGE_ID phpunit -c tests/phpunit.xml ./
```

## Tests
```sh
phpcs --standard=psr2 CollectionJson
cd tests
phpunit ./
```

## License
The MIT License (MIT)

Copyright (c) 2013 Kanstantsin Kamkou

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
