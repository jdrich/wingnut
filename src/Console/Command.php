<?php

namespace Wingnut\Console;

abstract class Command extends \ConsoleKit\Command {
    protected $environment;

    public function __invoke(array $args, array $options = []) {
        $this->preExecute($options);
        
        $this->execute($args, $options);
    }

    public function __construct($console, \Wingnut\Environment $environment) {
        parent::__construct($console);

        $this->environment = $environment;
    }
    
    protected function preExecute($options) {
        if(isset($options['config'])) {
            $this->environment->loadConfig($options['config']);
        } else {
            $this->environment->loadConfig();
        }
    }
}
