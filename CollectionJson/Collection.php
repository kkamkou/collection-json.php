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

class Collection
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

    public function setTemplate(Collection\Template $tpl)
    {
        $this->template = $tpl;
        return $this;
    }

    public function setError(Collection\Error $err)
    {
        $this->error = $err;
        return $this;
    }

    public function addLink(Collection\Link $link)
    {
        $this->links[] = $link;
        return $this;
    }

    public function addItem(Collection\Item $item)
    {
        $this->items[] = $item;
        return $this;
    }

    public function addQuery(Collection\Query $query)
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

        // we have an error object
        if ($this->error) {
            $collection['error'] = $this->error->__toArray();
        }

        // we have a template object
        if ($this->template) {
            $collection['template'] = $this->template->__toArray();
        }

        // encoding data
        return json_encode(array('collection' => $collection));
    }
}
