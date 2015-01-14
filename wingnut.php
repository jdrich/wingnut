<?php

require_once 'vendor/autoload.php';

$console = new ConsoleKit\Console();
$console->addCommands([
    new Wingnut\Find($console)
]);

/**
 * We need the following commands:
 *
 * wingnut Find (filter) - lists all the files discovered by the filter
 * wingnut Dryrun (publisher) - Creates all of the files associated with the publish cycle and dumps them into `tmp`
 * wingnut Publish (publisheR) - Creates all of the files associated with the publish cycle and copies them to the destination directory.
 * wingnut Explain (config filename) - Explains all of the configuration delineated in the configuration file.
 * wingnut publishAll - Runs all publishers sequentially.
 * wingnut help find
 * wingnut help dryrun
 * wingnut help publish
 */

// The WindowsTextWriter strips all the linux/unix color codes from the output.
if(strpos(strtolower(php_uname()), 'windows') !== false) {
    $console->setTextWriter(new Wingnut\WindowsTextWriter());
}

$console->run();
