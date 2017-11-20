<?php

namespace Wingnut\Map;

class Json extends Map {
    protected $options = [
        'assoc' => true  
    ];
    
    protected function map(array $input) {
        $return = [];
        
        foreach($input as $data) {
            $return[] = json_decode($data, $this->options['assoc']);
        }
        
        return $return;
    }
}