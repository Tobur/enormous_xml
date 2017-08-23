<?php

namespace EnormousXml\Service\Parser;

use Exception;

class XMLParserService
{
    /**
     * @var resource
     */
    protected $parser;

    /**
     * @var array
     */
    protected $currentData = [];

    /**
     * @var string
     */
    protected $currentTag;

    /**
     * @var array
     */
    protected $ignoreTags = [];

    /**
     * @var string
     */
    protected $endTag;

    /**
     * @var XMLParserHandler
     */
    protected $callbackHandler;
    
    /**
     * Bytes to read from file per one iteration
     * 
     * @var int
     */
    protected $readBuffer = 1000;

    /**
     * @param XMLParserHandler $callbackHandler
     */
    public function __construct(XMLParserHandler $callbackHandler)
    {
        $this->callbackHandler = $callbackHandler;
        $this->parser = xml_parser_create('UTF-8');

        xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, 0);
        xml_set_object($this->parser, $this);
        xml_set_element_handler($this->parser, 'startTag', 'endTag');
        xml_set_character_data_handler($this->parser, 'tagData');
    }

    /**
     * @param array $tags
     */
    public function setIgnoreTags(array $tags)
    {
        $this->ignoreTags = $tags;
    }

    /**
     * @param string $tag
     */
    public function setEndTag($tag)
    {
        $this->endTag = $tag;
    }

    /**
     * @param resource $parser
     * @param string $name
     * @return void
     */
    public function startTag($parser, $name)
    {
        if (in_array($name, $this->ignoreTags)) {
            $this->currentTag = null;

            return;
        }
        $this->currentTag = $name;
    }

    /**
     * @param resource $parser
     * @param string $data
     */
    public function tagData($parser, $data)
    {
        if ($this->currentTag) {
            if (!isset($this->currentData[$this->currentTag])) {
                $this->currentData[$this->currentTag] = '';
            }
            $this->currentData[$this->currentTag] .= trim($data);
        }
    }

    /**
     * @param resource $parser
     * @param string $name
     */
    public function endTag($parser, $name)
    {
        if ($name == $this->endTag) {
            $this->callbackHandler->onItemParsed($this->currentData);
            $this->currentData = array();
        }
    }

    /**
     * @param string $file
     * @throws Exception
     */
    public function parse($file)
    {
        $handle = fopen($file, 'r');
        if (!$handle) {
            throw new Exception('Unable to open file.');
        }

        while (!feof($handle)) {
            $data = fread($handle, $this->readBuffer);
            xml_parse($this->parser, $data, feof($handle));
        }
    }
}
