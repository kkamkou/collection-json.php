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

class Error implements ArrayConvertible
{
    /** @var string */
    protected $title;

    /** @var string */
    protected $code;

    /** @var string */
    protected $message;

    /**
     * Constructor
     *
     * @param string $title (Default: null)
     * @param string $code (Default: null)
     * @param string $message (Default: null)
     */
    public function __construct($title = null, $code = null, $message = null)
    {
        $this->setTitle($title)
            ->setCode($code)
            ->setMessage($message);
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /** @return string */
    public function getCode()
    {
        return (null === $this->code) ? null : (string)$this->code;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /** @return string */
    public function getMessage()
    {
        return (null === $this->message) ? null : (string)$this->message;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /** @return string */
    public function getTitle()
    {
        return (null === $this->title) ? null : (string)$this->title;
    }

    /** @return array */
    public function __toArray()
    {
        return array_filter(
            array(
                'title' => $this->getTitle(),
                'code' => $this->getCode(),
                'message' => $this->getMessage()
            ),
            function ($val) {
                return ($val !== null);
            }
        );
    }
}
