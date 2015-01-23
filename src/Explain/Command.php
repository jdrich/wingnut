<?php

namespace Wingnut\Explain;

use ConsoleKit\Colors;

class Command extends \ConsoleKit\Command {
    private $messages = [];

    private $required = [
        
    ];

    private $explanations = [
    
    ];

    public function execute(array $args, array $options = []) {
        $filename = isset($args[0]) ? $args[0] : 'config.json';
        
        if(!file_exists($filename)) {
            $this->writeln('File not found: ' . $filename, Colors::RED);
            
            return;
        }
        
        @$file = file_get_contents($filename);
        
        if($file === false) {
            $this->writeln('Could not read: ' . $filename, Colors::RED);
            
            return;
        }
        
        if(isset($options['test']) || isset($options['t'])) {
            $this->test($file);
        } else {
            $json = json_decode($file);
            
            if($json === null) {
                $this->writeln('Invalid configuration file format: ' . $filename, Colors::RED);
                
                return;
            }    
        }
    }  
    
    private function test($file) {
        $config = json_decode($file);
        
        if($config === null) {
            $this->fail('JSON Decode error: ' . Json::mapError(json_last_error()) . ': ' . json_last_error_msg());
        } else {
            
        }
        
        $this->end();
    }
    
    private function fail($message) {
        $this->messages[] = $message;
    }
    
    private function end() {
        $this->writeln('Your configuration file is invalid. See below for errors.', Colors::RED);
        
        foreach($this->messages as $message) {
            $this->writeln('');
            $this->writeln(' * ' . $message, Colors::RED);
        }
    }
}