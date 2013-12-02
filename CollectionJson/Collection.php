<?php

namespace CollectionJson;

class Collection
{
    /** @var string */
    protected $version = '1.0';

    /** @var string */
    protected $href = null;

    /** @var array of Link */
    protected $links = array();

    /** @var array of Item */
    protected $items = array();

    /** @var array of Query */
    protected $queries = array();

    /** @var Template */
    protected $template = null;

    /** @var Error */
    protected $error = null;

    public function getVersion()
    {
        return $this->version;
    }

    public function getHref()
    {
        return $this->href;
    }

    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    public function setTemplate(Template $tpl)
    {
        $this->tpl = $tpl;
        return $this;
    }

    public function setError(Error $err)
    {
        $this->error = $err;
        return $this;
    }

    public function addLink(Link $link)
    {
        $this->links[] = $link;
        return $this;
    }

    public function addItem(Item $item)
    {
        $this->items[] = $item;
        return $this;
    }

    public function addQuery(Query $query)
    {
        $this->queries[] = $query;
        return $this;
    }

    public function __toString()
    {
        return $this->encode();
    }

    protected function encode()
    {
        // extension validation
        if (!extension_loaded('json')) {
            throw new \RuntimeException('the json extension is required for this library');
        }

        // defaults
        $collection = array(
            'version' => $this->getVersion(),
            'href' => $this->getHref()
        );

        // encoding data
        return json_encode(array('collection' => $collection));
    }
}
