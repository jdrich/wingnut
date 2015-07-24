<?php

namespace Wingnut\Map;

class Json extends Map {
    $this->assoc
    
    public function __construct(array $conf = []) {
        $this->assoc = isset($conf['assoc']) ? (bool)$conf['assoc'] : false;
    }
    
    protected function map(array $input) {
        $return = [];
        
        foreach($input as $data) {
            $return[] = json_decode($data, $this->assoc);
        }
        
        return $return;
    }
}