<?php

namespace Wingnut\Map;

class Reverse extends Map {
    protected function map(array $input) {
        return array_reverse($input);
    }
}