<?php

require_once 'vendor/autoload.php';

$console = new ConsoleKit\Console(

);

// The WindowsTextWriter strips all the linux/unix color codes from the output.
if(strpos(strtolower(php_uname()), 'windows') !== false) {
    $console->setTextWriter(new Wingnut\WindowsTextWriter());
}

$console->run();
