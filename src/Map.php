<?php

namespace Wingnut;

final class Map extends Console\Command {
    public function execute(array $args, array $options = []) {
        $map = $this->environment->getMap($args[0]);
        
        var_dump($map); die();
        
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
