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
 * Class Data
 *
 * @package CollectionJson\Property
 */
class Data implements ArrayConvertible
{
    /** @var string */
    protected $name;

    /** @var mixed */
    protected $value;

    /** @var string */
    protected $prompt;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $value (Default: null)
     * @param string $prompt (Default: null)
     */
    public function __construct($name, $value = null, $prompt = null)
    {
        $this->setName($name)
            ->setValue($value)
            ->setPrompt($prompt);
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
        return (string)$this->name;
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
        return (null === $this->prompt) ? null : (string)$this->prompt;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /** @return mixed */
    public function getValue()
    {
        return (null === $this->value) ? '' : $this->value;
    }

    /** @return array */
    public function __toArray()
    {
        $required = array('name' => $this->getName());
        return $required + array_filter(
            array('value' => $this->getValue(), 'prompt' => $this->getPrompt()),
            function ($val) {
                return ($val !== null);
            }
        );
    }
}
