<?php
/**
 * Licensed under the MIT License
 *
 * @author   Kanstantsin A Kamkou (2ka.by)
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://github.com/kkamkou/collection-json.php
 */

namespace CollectionJson\Collection;

use CollectionJson\Interfaces\ArrayConvertible;
use CollectionJson\Property\Data;
use CollectionJson\Property\Link;

/**
 * Class Item
 *
 * @package CollectionJson\Collection
 */
class Item implements ArrayConvertible
{

    /** @var string */
    protected $href;

    /** @var array of Property\Data */
    protected $data = array();

    /** @var array of Property\Link */
    protected $links = array();

    /**
     * Constructor
     *
     * @param string $href
     * @param array $setWithData (Default: array())
     * @param array $setWithLinks (Default: array())
     */
    public function __construct($href, array $setWithData = array(), array $setWithLinks = array())
    {
        $this->setHref($href)
            ->addDataSet($setWithData)
            ->addLinkSet($setWithLinks);
    }

    /**
     * Adds multiple data entries at once
     *
     * @param array $setWithData
     * @return $this
     */
    public function addDataSet(array $setWithData = array())
    {
        foreach ($setWithData as $data) {
            $this->addData($data);
        }
        return $this;
    }

    /**
     * @param Data $data
     * @return $this
     */
    public function addData(Data $data)
    {
        $this->data[] = $data;
        return $this;
    }

    /**
     * Adds multiple link entries at once
     *
     * @param array $setWithLinks
     * @return $this
     */
    public function addLinkSet(array $setWithLinks = array())
    {
        foreach ($setWithLinks as $link) {
            $this->addLink($link);
        }
        return $this;
    }

    /**
     * @param Link $link
     * @return $this
     */
    public function addLink(Link $link)
    {
        $this->links[] = $link;
        return $this;
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
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /** @return array */
    public function __toArray()
    {
        $return = array('href' => $this->getHref());

        if (count($this->data)) {
            foreach ($this->getData() as $data) {
                $return['data'][] = $data->__toArray();
            }
        }

        if (count($this->links)) {
            foreach ($this->getLinks() as $link) {
                $return['links'][] = $link->__toArray();
            }
        }

        return $return;
    }
}
