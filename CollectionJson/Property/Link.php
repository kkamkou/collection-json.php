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
 * Class Link
 *
 * @package CollectionJson\Property
 */
class Link implements ArrayConvertible
{
    /** @var string */
    protected $href;

    /** @var string */
    protected $rel;

    /** @var string */
    protected $name;

    /** @var string */
    protected $render;

    /** @var string */
    protected $prompt;

    /**
     * Constructor
     *
     * @param string $href
     * @param string $rel
     * @param string $name (Default: null)
     * @param string $render (Default: null)
     * @param string $prompt (Default: null)
     */
    public function __construct($href, $rel, $name = null, $render = 'link', $prompt = null)
    {
        $this->setHref($href)
            ->setRel($rel)
            ->setName($name)
            ->setRender($render)
            ->setPrompt($prompt);
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
     * @param string $render (can be "image" or "link")
     * @throws \InvalidArgumentException if type is invalid
     * @return $this
     */
    public function setRender($render)
    {
        if (!in_array($render, array('image', 'link'))) {
            throw new \InvalidArgumentException(
                "The '{$render}' render type is invalid. Accepted: image, link"
            );
        }

        $this->render = $render;
        return $this;
    }

    /** @return string */
    public function getRender()
    {
        return $this->render;
    }

    /** @return array */
    public function __toArray()
    {
        $required = array('href' => $this->getHref(), 'rel' => $this->getRel());
        return $required + array_filter(
            array(
                'prompt' => $this->getPrompt(),
                'name' => $this->getName(),
                'render' => $this->getRender()
            ),
            function ($val) {
                return ($val !== null);
            }
        );
    }
}
