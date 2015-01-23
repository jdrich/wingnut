<?php

namespace Wingnut;

use Symfony\Component\Finder\Finder;

class Filter {
    private $finder;

    public function __construct(Finder $finder) {
        $this->finder = $finder;
    }

    final public function filter($pattern, $map = false, $directory = false) {
        $directory = $directory ? $directory : getcwd();

        $finder = $this->find($directory);
        $files = [];

        foreach($finder as $file_info) {
            $rel = $file_info->getRelativePathname();
            $path = $directory . DIRECTORY_SEPARATOR . $rel;

            $captures = [];

            if($this->match($pattern, $rel, $captures)) {
                $file = [
                    'file' => $path
                ];

                if(is_array($map)) {
                    foreach($this->map($map, $captures) as $key => $value) {
                        $file[$key] = $value;
                    }
                }

                $files[] = $file;
            }
        }

        return $files;
    }

    protected function find($directory) {
        $finder = $this->finder;

        $finder->files();
        $finder->ignoreDotFiles(true);
        $finder->ignoreVCS(true);
        $finder->sortByName();

        $finder->in($directory);

        return $finder->files();
    }

    protected function match($pattern, $file_info, &$captures) {
        return preg_match($pattern, $file_info, $captures);
    }

    protected function map($map, $captures) {
        $maps = [];

        foreach($map as $index => $key) {
            $maps[$key] = isset($captures[$index+1]) ? $captures[$index+1] : null;
        }

        return $maps;
    }
}
