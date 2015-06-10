<?php

namespace Wingnut\Console;

use \ConsoleKit\TextWriter;

class HtmlTextWriter implements TextWriter {
    private $header = '<html><head><title>Wingnut Command Output</title></head><body>';

    private $footer = '</body></html>';

    private $pipes;

    private $lastpipe;

    public function __construct() {
        $this->pipes = [];
    }

    public function __destruct() {
        foreach($this->pipes as $pipe) {
            $this->write($this->footer, $pipe, true);
        }
    }

    public function write($text ='', $pipe = TextWriter::STDOUT, $raw = false) {
        if(!in_array($pipe, $this->pipes)) {
            $this->pipes[] = $pipe;
            $this->write($this->header, $pipe, true);
        }

        $f = fopen('php://' . $pipe, 'w');

        if($raw) {
            $string = $this->stripCodes($text);
        } else {
            $string = '<pre>' . htmlspecialchars($this->stripCodes($text)) . '</pre>';
        }

        $string = str_replace(' ', '&nbsp;', $string) . "\n";

        fwrite($f, $string);

        fclose($f);
    }

    public function writeln($text ='', $pipe = TextWriter::STDOUT) {
        $this->write('<h4>' . htmlspecialchars($this->stripCodes($text)) . '</h4>', $pipe, true);
    }

    private function stripCodes($text) {
        return preg_replace('/\x1b\[[0-9;]*m/', '', $text);
    }
}
