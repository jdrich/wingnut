<?php

namespace Wingnut\Map;

class Order extends Map {
    protected $options = [
        'fields' => []  
    ];
    
    protected function map(array $input) {
        $return = $input;
        
        $fields = $this->options['fields'];
        
        usort(
            $return, 
            function ($a, $b) use ($fields) {
                foreach($fields as $field) {
                    if($a[$field] < $b[$field]) {
                        return -1;
                    } 
                    
                    if($a[$field] > $b[$field]) {
                        return 1;
                    }
                }
                
                return 0;
            }
        );
        
        return $return;
    }
}