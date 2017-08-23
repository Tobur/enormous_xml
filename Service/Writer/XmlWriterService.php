<?php

namespace EnormousXml\Service\Writer;

class XmlWriterService
{
    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var resource
     */
    protected $handler;

    public function __construct()
    {
        $this->reset();
    }

    /**
     * @param string $tag
     * @return self
     */
    public function writeOpenTag($tag)
    {
        fwrite($this->handler, sprintf('<%s>', $tag));
        $this->newLine();

        return $this;
    }

    /**
     * @param string $tag
     * @return $this
     */
    public function writeCloseTag($tag)
    {
        fwrite($this->handler, sprintf('<%s>', $tag));
        $this->newLine();

        return $this;
    }

    /**
     * @param strin $tag
     * @param string $value
     */
    public function writeTagValue($tag, $value)
    {
        fwrite($this->handler, sprintf('<%s>%s</%s>', $tag, $value, $tag));
        $this->newLine();
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @return void
     */
    protected function newLine()
    {
        fwrite($this->handler, "\n");
    }

    /**
     * @return void
     */
    public function reset()
    {
        $this->filePath = tempnam(sys_get_temp_dir(), 'enourmous_xml');
        $this->handler = fopen($this->filePath,"a");
        fwrite($this->handler, '<?xml version="1.0" encoding="UTF-8"?>');
        $this->newLine();
    }

    public function __destruct()
    {
        fclose($this->handler);
    }
}

