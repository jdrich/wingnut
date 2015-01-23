<?php

namespace Wingnut;

final class Find extends \ConsoleKit\Command {
    private $environment;

    public function __invoke(array $args, array $options = []) {
        $this->execute($args, $options);
    }

    public function __construct($console, Environment $environment) {
        parent::__construct($console);

        $this->environment = $environment;
    }

    public function execute(array $args, array $options = []) {
        if(isset($options['config'])) {
            $this->environment->loadConfig($options['config']);
        } else {
            $this->environment->loadConfig();
        }

        $files = $this->environment->getFilter($args[0]);

        foreach($files as $file) {
            $this->writeln($file['file']);

            foreach($file as $key => $value) {
                if($key == 'file') {
                    continue;
                }

                $this->writeln('    ' . $key . ' = ' . $value);
            }
        }
    }
}
