<?php

namespace EnormousXml\Service;

use EnormousXml\Helper\FilterHelper;
use EnormousXml\Helper\MessageHelper;
use EnormousXml\Input\ArgvInput;
use EnormousXml\Input\EnumInput;
use EnormousXml\Models\User;
use EnormousXml\Service\Parser\XMLParserService;
use EnormousXml\Service\Parser\XMLParserHandler;
use EnormousXml\Service\Writer\XmlWriterService;

class HandlerCLIService
{
    /**
     * @var ArgvInput
     */
    protected $input;

    /**
     * @param ArgvInput $input
     */
    public function __construct(ArgvInput $input)
    {
        $this->input = $input;
        $this->xmlWriter = new XmlWriterService();
    }

    /**
     * @return string
     */
    public function run() {

        $help = $this->input->get(EnumInput::HELP);

        if ($help || !$this->input->isArgumentsExist()) {
            MessageHelper::showMessageHelp();

            return false;
        }

        $handler = new XMLParserHandler();
        $handler->setOnItemParsedCallback(function ($item) {
            $this->processItem($item);
        });
        $parser = new XMLParserService($handler);
        $parser->setIgnoreTags(['users', 'user']);
        $parser->setEndTag('user');
        $this->writeHeaderXml();
        $parser->parse($this->input->get(EnumInput::PATH_TO_FILE));
        $this->writeFooterXml();

        return $this->xmlWriter->getFilePath();
    }

    /**
     * @param array $item
     */
    protected function processItem(array $item)
    {
        $user = new User();
        foreach ($item as $key => $value) {
            $method = sprintf('set%s', ucfirst(strtolower($key)));
            $user->$method($value);
        }

        if (!$this->isAllowImportToFile($user)) {
            return;
        }

        $this->writeToFile($user);
        unset($user);
    }

    /**
     * @param User $user
     */
    protected function writeToFile(User $user)
    {
        $this->xmlWriter->writeOpenTag('user');
        $this->xmlWriter->writeTagValue('age', $user->getAge());
        $this->xmlWriter->writeTagValue('name', $user->getName());
        $this->xmlWriter->writeTagValue('email', $user->getEmail());
        $this->xmlWriter->writeTagValue('id', $user->getId());
        $this->xmlWriter->writeCloseTag('user');
    }

    /**
     * @return void
     */
    protected function writeHeaderXml()
    {
        $this->xmlWriter->writeOpenTag('users');
    }

    /**
     * @return void
     */
    protected function writeFooterXml()
    {
        $this->xmlWriter->writeCloseTag('users');
    }

    /**
     * @param User $user
     * @return bool
     */
    protected function isAllowImportToFile(User $user)
    {
        $filterFields = $this->input->getFilterFields();
        if (!FilterHelper::isAllowFilterPerAge($filterFields, $user->getAge())) {
            return false;
        }

        if (!FilterHelper::isAllowFilterPerEmail($filterFields, $user->getEmail())) {
            return false;
        }

        if (!FilterHelper::isAllowFilterPerId($filterFields, $user->getId())) {
            return false;
        }

        if (!FilterHelper::isAllowFilterPerName($filterFields, $user->getName())) {
            return false;
        }

        return true;
    }
}

