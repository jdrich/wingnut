<?php

namespace Wingnut\Map;

abstract class Map {
    final public function __invoke($input) {
        return $this->map($input);
    }
    
    abstract protected function map(array $input);
}