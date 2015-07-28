<?php

namespace Wingnut\Map;

abstract class Map {
    protected $options = [];
    
    public function __construct($options = []) {
        foreach(array_keys($this->options) as $option) {
            if(isseT($options[$option])) {
                $this->options[$option] = $options[$option];
            }
        }
    }
    
    final public function __invoke($input) {
        return $this->map($input);
    }
    
    abstract protected function map(array $input);
}