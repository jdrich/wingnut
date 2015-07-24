<?php

namespace Wingnut\Map;

class JsonFile extends Map {
    protected function map(array $files) {
        $mapped = [];
        
        foreach($files as $file) {
            if(!file_exists($file['file'])) {
                throw new \RuntimeException('Could not find file for filter: ' . $file['file']);
            } 
            
            $json = json_decode(file_get_contents($file['file']), true);
            
            if($json == false) {
                throw new \RuntimeException('Could not decode json from file: ' . $file['file']);
            }
            
            $mapped[] = array_merge($file, $json);
        }
        
        return $mapped;
    }
}