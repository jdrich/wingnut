<?php

namespace Wingnut\Map;

class JsonFile extends File {
    protected $options = [
        'file_key' => 'file',
        'assoc' => true
    ];
    
    protected function map(array $files) {
        $mapped = [];
        
        foreach($files as $file) {
            $json = json_decode($this->load($file[$this->options['file_key']]), $this->options['assoc']);
            
            if($json == false) {
                throw new \RuntimeException('Could not decode json from file: ' . $file[$this->options['file_key']]);
            }
            
            $mapped[] = array_merge($file, $json);
        }
        
        return $mapped;
    }
}