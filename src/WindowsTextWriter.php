<?php

namespace Wingnut;

use \ConsoleKit\TextWriter;

/**
 * This class is the same as the StdTextWriter except it strips all of the color codes from the output.
 */
class WindowsTextWriter implements TextWriter {
    public function write($text ='', $pipe = TextWriter::STDOUT) {
        $f = fopen('php://' . $pipe, 'w');
        fwrite($f, $this->stripCodes($text));
        fclose($f);
    }

    public function writeln($text ='', $pipe = TextWriter::STDOUT) {
        $this->write($this->stripCodes($text) . "\n", $pipe);
    }

    private function stripCodes($text) {
        return preg_replace('/\x1b\[[0-9;]*m/', '', $text);
    }
}
