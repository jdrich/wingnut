<?php

namespace Wingnut\Map;

class File extends Map {
    protected $options = [
        'file_key' => 'file',
        'data_key' => 'data'
    ];
    
    protected function map(array $files) {
        $mapped = [];
        
        foreach($files as $file) {
            $data = $this->load($file[$this->options['file_key']]);
            
            $mapped[] = array_merge($file, [ $this->options['data_key'] => $data ]);
        }
        
        return $mapped;
    }
    
    protected function load($file_name) {
        if(!file_exists($file_name)) {
            throw new \RuntimeException('Could not find file for filter: ' . $file_name);
        } 
            
        $file = file_get_contents($file_name);
        
        if($file === false) {
            throw new \RuntimeException('Could not open file: ' . $file_name);
        }
        
        return $file;
    }
}