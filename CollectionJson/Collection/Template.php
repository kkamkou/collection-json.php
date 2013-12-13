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

/**
 * Class Template
 *
 * @package CollectionJson\Collection
 */
class Template implements ArrayConvertible
{
    /** @var array of Property\Data */
    protected $data = array();

    /**
     * Constructor
     * 
     * @param array $setWithData
     */
    public function __construct(array $setWithData = array())
    {
        $this->addDataSet($setWithData);
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
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /** @return array */
    public function __toArray()
    {
        $return = array('template' => array('data' => array()));
        foreach ($this->getData() as $data) {
            $return['template']['data'][] = $data->__toArray();
        }
        return $return;
    }
}
