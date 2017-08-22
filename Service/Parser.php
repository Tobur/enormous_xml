<?php

namespace EnormousXml\Service;

class Parser
{
    /**
     * @var string
     */
    protected $pathToFile;

    /**
     * @var array
     */
    protected $filterFields;

    /**
     * @param string $pathToFile
     * @return self
     */
    public function setPathToFile($pathToFile)
    {
        $this->pathToFile = $pathToFile;

        return $this;
    }

    public function setFilterFields(array $filterFields)
    {
        $this->filterFields = $filterFields;

        return $this;
    }

    public function parseXml()
    {

    }

}

