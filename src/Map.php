<?php

namespace Wingnut;

final class Map extends Console\Command {
    public function execute(array $args, array $options = []) {
        $map = $this->environment->getMap($args[0]);
        
        $first = true;
        
        foreach($map as $item) {
            $first || $this->writeln('---');
            
            $this->nestedPrint($item);
            
            $first = false;
        }
    }
    
    protected function nestedPrint($item, $depth = 0) {
        if(!is_array($item)) {
            $this->writeNested((string)$item, $depth);
            
            return;
        }
        
        foreach($item as $key => $value) {
            if(is_int($key)) {
                $this->nestedPrint($value, $depth + 1);
            } else {
                $this->writeNested($key, $depth);
                
                $this->nestedPrint($value, $depth + 1);
            }
        }
    }
    
    protected function writeNested($string, $depth) {
        $this->writeln(str_repeat('  ', $depth) . $string);
    }
}
