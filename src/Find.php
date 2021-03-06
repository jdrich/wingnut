<?php

namespace Wingnut;

final class Find extends Console\Command {
    public function execute(array $args, array $options = []) {
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
