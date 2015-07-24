<?php

namespace Wingnut;

use Symfony\Component\Finder\Finder;

final class Environment {
    private $config;

    public function loadConfig($config_file = false) {
        if($config_file === false) {
            $config_file = 'config.json';
        }
        
        $this->config = @json_decode((new \MatthiasMullie\Minify\JS($config_file))->minify(), true);
        
        if($this->config === null) {
            throw new \RuntimeException('Could not load config file: ' . $config_file);
        }
    }

    public function getFilter($filter_name) {
        $filters = $this->config['filters'];

        if(!isset($filters[$filter_name])) {
            throw new \InvalidArgumentException('Filter not defined by configuration: ' . $filter_name);
        }

        $filter = $filters[$filter_name];

        $class = isset($filter['class']) ? $filter['class'] : 'Wingnut\Filter';
        $pattern = isset($filter['pattern']) ? $filter['pattern'] : '*';
        $map = isset($filter['map']) ? $filter['map'] : null;
        $directory = isset($filter['directory']) ? $filter['directory'] : getcwd();

        $filter = new $class(new Finder());

        return $filter->filter($pattern, $map, $directory);
    }
    
    public function getMap($map_name) {
        $maps = $this->config['maps'];
        
        $config = $this->config['maps'][$map_name];
        
        $map_class = $config['class'];
        
        if(!class_exists($map_class)) {
            throw new \InvalidArgumentException('Map class not found: ' . $map_class);
        }
        
        $map = new $map_class();
        
        if(!isset($config['type'])) {
            $config['type'] = 'filter';
        }
        
        switch($config['type']) {
            case 'filter': 
                $items = $this->getFilter($config['source']); 
                
                break;
            case 'map': 
                $items = $this->getMap($config['source']);
                
                break;
            default:
                throw new \InvalidArgumentException('Map type invalid: ' . $config['type']);
        }
        
        return $map($items);
    }
}
