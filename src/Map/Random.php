<?php

namespace Wingnut\Map;

class Random extends Map {
    protected $options = [
        'count' => 1  
    ];
    
    protected function map(array $input) {
        $return = [];
        
        $count = $this->options['count'];
        
        if(count($input) < $count) {
            $count = count($input);
        }
        
        $keys = array_rand($input, $this->options['count']);
        
        if(!is_array($keys)) {
            $keys = [$keys];
        }
        
        shuffle($keys);
        
        foreach($keys as $key) {
            $return[] = $input[$key];
        }
        
        return $return;
    }
}