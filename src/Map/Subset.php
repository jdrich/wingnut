<?php

namespace Wingnut\Map;

class Subset extends Map {
    protected $options = [
        'offset' => null,
        'length' => null
    ];
    
    protected function map(array $input) {
        $offset = $this->options['offset'];
        $length = $this->options['length'];
        
        if($offset === null) {
            throw new \InvalidArgumentException('Subset map incorrectly configured. The "offset" option is required.');
        }
        
        if($length === null) {
            return array_slice($input, $offset);
        } 
        
        return array_slice($input, $offset, $length);
    }
}