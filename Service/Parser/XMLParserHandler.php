<?php

namespace EnormousXml\Service\Parser;

class XMLParserHandler
{
    /**
     * @var \Closure
     */
    protected $onItemParsedCallback;

    /**
     * @param array $item
     */
    public function onItemParsed(array $item)
    {
        if (is_callable($this->onItemParsedCallback)) {
            $callback = $this->onItemParsedCallback;
            $callback($item);
        }
    }

    /**
     * @param callable $callback
     */
    public function setOnItemParsedCallback(callable $callback)
    {
        $this->onItemParsedCallback = $callback;
    }
}
