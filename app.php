<?php

namespace EnormousXml;

require './autoload.php';

use EnormousXml\Input\ArgvInput;
use EnormousXml\Service\HandlerCLIService;
use EnormousXml\Service\Parser\XMLParserHandler;
use EnormousXml\Service\Parser\XMLParserService;
use EnormousXml\Service\Writer\XmlWriterService;

$argvInput = new ArgvInput($argv);
$xmlWriter = new XmlWriterService();

$handlerCLI = new HandlerCLIService($argvInput, $xmlWriter);
$handler = new XMLParserHandler();
$parser = new XMLParserService($handler);
$filePath = $handlerCLI->processXML($handler, $parser);
echo "\n";
echo "\n";
echo $filePath;
echo "\n";