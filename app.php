<?php

namespace EnormousXml;

require './autoload.php';

use EnormousXml\Input\ArgvInput;
use EnormousXml\Service\HandlerCLIService;

$argvInput = new ArgvInput($argv);
$handlerCLI = new HandlerCLIService($argvInput);
$filePath = $handlerCLI->run();
echo "\n";
echo "\n";
echo $filePath;
echo "\n";