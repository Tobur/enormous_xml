<?php

namespace EnormousXml\Service;

use EnormousXml\Helper\MessageHelper;
use EnormousXml\Input\ArgvInput;
use EnormousXml\Input\InputEnum;

class HandlerCLI
{
    /**
     * @var ArgvInput
     */
    protected $input;

    /**
     * @var Parser
     */
    protected $parser;

    public function __construct(ArgvInput $input)
    {
        $this->input = $input;
        $this->parser = new Parser();
    }

    /**
     * @return string
     */
    public function run() {

        $help = $this->input->get(InputEnum::HELP);

        if ($help || !$this->input->isArgumentsExist()) {
            MessageHelper::showMessageHelp();

            return false;
        }

        $this->parser->setPathToFile($this->input->get(InputEnum::PATH_TO_FILE))
                ->setFilterFields($this->input->getFilterFields())
                ->parseXml();
    }
}

