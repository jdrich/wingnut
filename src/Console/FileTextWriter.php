<?php

namespace Wingnut\Console;

use \ConsoleKit\TextWriter;

class FileTextWriter implements TextWriter {
    private $text_writer;
    private $file;

    public function __construct($file, TextWriter $text_writer) {
        $this->file = $file;
        $this->text_writer = $text_writer;
    }

    public function write($text ='', $pipe = TextWriter::STDOUT) {
        ob_start();

        $this->text_writer->write($text, $pipe);

        $text = ob_get_clean();

        $fh = fopen($this->file, 'a');

        fwrite($fh, $text);

        fclose($fh);
    }

    public function writeln($text ='', $pipe = TextWriter::STDOUT) {
        ob_start();

        $this->text_writer->writeln($text, $pipe);

        $text = ob_get_clean();

        $fh = fopen($this->file, 'a');

        fwrite($fh, $text);

        fclose($fh);
    }
}
