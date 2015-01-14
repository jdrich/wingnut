<?php

namespace Wingnut;

class Find extends \ConsoleKit\Command {
    public function execute(array $args, array $options = []) {
        var_dump($args, $options);

        $this->writeln("Hello, $!");
    }
}
