<?php

namespace EnormousXml;

require './autoload.php';

use EnormousXml\Input\ArgvInput;
use EnormousXml\Service\HandlerCLI;

$argvInput = new ArgvInput($argv);
$handlerCLI = new HandlerCLI($argvInput);
$handlerCLI->run();


