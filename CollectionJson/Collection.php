<?php
/**
 * Licensed under the MIT License
 *
 * @author   Kanstantsin A Kamkou (2ka.by)
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://github.com/kkamkou/collection-json.php
 */

/**
 * Specification:
 *  @link http://amundsen.com/media-types/collection/
 *
 * Discussion Group:
 *  @link https://groups.google.com/forum/?fromgroups#!forum/collectionjson
 */

namespace CollectionJson;

use CollectionJson\Interfaces\ArrayConvertible;

/**
 * Class Collection
 *
 * @package CollectionJson
 */
class Collection implements ArrayConvertible
{
    /** @var string */
    protected $version = '1.0';

    /** @var string */
    protected $href;

    /** @var array of Collection\Link */
    protected $links = array();

    /** @var array of Collection\Item */
    protected $items = array();

    /** @var array of Collection\Query */
    protected $queries = array();

    /** @var Collection\Template */
    protected $template;

    /** @var Collection\Error */
    protected $error;

    /**
     * Constructor
     *
     * @param string $href
     * @throws \RuntimeException if json extension is not found
     */
    public function __construct($href)
    {
        // extension validation
        if (!extension_loaded('json')) {
            throw new \RuntimeException('the json extension is required for this library');
        }

        $this->setHref($href);
    }

    /**
     * @param string $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /** @return string */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $href
     * @return $this
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /** @return string */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param Collection\Template $tpl
     * @return $this
     */
    public function setTemplate(Collection\Template $tpl)
    {
        $this->template = $tpl;
        return $this;
    }

    /**
     * @param Collection\Error $err
     * @return $this
     */
    public function setError(Collection\Error $err)
    {
        $this->error = $err;
        return $this;
    }

    /**
     * @param array $linkSet
     * @return $this
     */
    public function addLinkSet(array $linkSet)
    {
        foreach ($linkSet as $link) {
            $this->addLink($link);
        }
        return $this;
    }

    /**
     * @param Property\Link $link
     * @return $this
     */
    public function addLink(Property\Link $link)
    {
        $this->links[] = $link;
        return $this;
    }

    /**
     * @param array $itemSet
     * @return $this
     */
    public function addItemSet(array $itemSet)
    {
        foreach ($itemSet as $item) {
            $this->addItem($item);
        }
        return $this;
    }

    /**
     * @param Collection\Item $item
     * @return $this
     */
    public function addItem(Collection\Item $item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @param array $querySet
     * @return $this
     */
    public function addQuerySet(array $querySet)
    {
        foreach ($querySet as $query) {
            $this->addQuery($query);
        }
        return $this;
    }

    /**
     * @param Property\Query $query
     * @return $this
     */
    public function addQuery(Property\Query $query)
    {
        $this->queries[] = $query;
        return $this;
    }

    /** @return string */
    public function __toString()
    {
        return json_encode($this->toArray());
    }

    /**
     * Converts the whole object to an array
     *
     * @return array
     */
    public function toArray()
    {
        // defaults
        $collection = array(
            'version' => $this->getVersion(),
            'href' => $this->getHref()
        );

        // we have an error object
        if ($this->error) {
            $collection['error'] = $this->error->toArray();
        }

        // we have a template object
        if ($this->template) {
            $collection = array_merge($collection, $this->template->toArray());
        }

        // we have some other objects
        foreach (array('items', 'queries', 'links') as $type) {
            if (count($this->{$type})) {
                foreach ($this->{$type} as $item) {
                    $collection[$type][] = $item->toArray();
                }
            }
        }

        // encoding data
        return array('collection' => $collection);
    }
}
