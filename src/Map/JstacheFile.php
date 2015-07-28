<?php

namespace Wingnut\Map;

class JstacheFile extends File {
    protected $options = [
        'file_key' => 'file',
        'data_key' => 'data'
    ];
    
    protected function map(array $files) {
        $mapped = [];
        
        foreach($files as $file) {
            $data = $this->load($file[$this->options['file_key']]);
            
            $chunks = explode("\n~~~\n", $data);
            
            if(count($chunks) != 2) {
                throw new \RuntimeException('Failed to load Jstache file: ' . $file[$this->options['file_key']]);
            }
            
            $json = json_decode($chunks[0], true);
            
            if($json === null) {
                throw new \RuntimeException('Failed to parse JSON component of Jstache file: ' . $file[$this->options['file_key']]);
            }
            
            $mapped[] = array_merge($file, $json, [ $this->options['data_key'] => $data ]);
        }
        
        return $mapped;
    }
}