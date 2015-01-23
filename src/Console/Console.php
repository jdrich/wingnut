<?php

namespace Wingnut\Console;

class Console extends \ConsoleKit\Console {
    protected $helpCommandClass = false;

    public function execute($command = null, array $args = array(), array $options = array()) {
        if(isset($options['format'])) {
            $format = $options['format'];

            if(!in_array($format, ['html','text'])) {
                throw new \RuntimeException('Unknown output format: ' . $format);
            }

            if($format === 'html') {
                $this->setTextWriter(new HtmlTextWriter());
            }
        }

        if(isset($options['output'])) {
            $file = $options['output'];

            if(file_exists($file)) {
                if(!unlink($file) || !touch($file)) {
                    throw new \RuntimeException('Could not prepare output file for writing: ' . $file);
                }
            }

            $this->setTextWriter(new FileTextWriter($file, $this->getTextWriter()));
        }

        return parent::execute($command, $args, $options);
    }
}
