<?php

namespace Wingnut;

use Symfony\Component\Finder\Finder;

final class Environment {
    private $config;

    public function loadConfig($config_file = false) {
        if($config_file === false) {
            $config_file = 'config.json';
        }

        $this->config = @json_decode(file_get_contents($config_file), true);

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
}
