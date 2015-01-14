<?php

require_once 'vendor/autoload.php';

$command = Wingnut\CommandParser()->parse($argv);

var_dump($command);
