<?php
/**
 * Licensed under the MIT License
 *
 * @author   Kanstantsin A Kamkou (2ka.by)
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://github.com/kkamkou/collection-json.php
 */

namespace CollectionJson\Property;

use CollectionJson\Interfaces\ArrayConvertible;

/**
 * Class Query
 *
 * @package CollectionJson\Property
 */
class Query implements ArrayConvertible
{
    /** @var string */
    protected $href;

    /** @var string */
    protected $rel;

    /** @var string */
    protected $name;

    /** @var string */
    protected $prompt;

    /** @var array of Data */
    protected $data = array();

    /**
     * Constructor
     *
     * @param string $href
     * @param string $rel
     * @param string $name (Default: null)
     * @param string $prompt (Default: null)
     * @param array $data (Default: null)
     */
    public function __construct($href, $rel, $name = null, $prompt = null, array $data = array())
    {
        $this->setHref($href)
            ->setRel($rel)
            ->setName($name)
            ->setPrompt($prompt)
            ->addDataSet($data);
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
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /** @return string */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $prompt
     * @return $this
     */
    public function setPrompt($prompt)
    {
        $this->prompt = $prompt;
        return $this;
    }

    /** @return string */
    public function getPrompt()
    {
        return $this->prompt;
    }

    /**
     * @param string $rel
     * @return $this
     */
    public function setRel($rel)
    {
        $this->rel = $rel;
        return $this;
    }

    /** @return string */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @param array $dataSet
     * @return $this
     */
    public function addDataSet(array $dataSet)
    {
        foreach ($dataSet as $data) {
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

    /** @return array */
    public function getData()
    {
        return $this->data;
    }

    /** @return array */
    public function __toArray()
    {
        $required = array('href' => $this->getHref(), 'rel' => $this->getRel());

        if (count($this->data)) {
            $required['data'] = array();
            foreach ($this->data as $data) {
                $required['data'][] = $data->__toArray();
            }
        }

        return $required + array_filter(
            array('prompt' => $this->getPrompt(), 'name' => $this->getName()),
            function ($val) {
                return ($val !== null);
            }
        );
    }
}
