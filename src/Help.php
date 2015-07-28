<?php

namespace Wingnut;

class Help extends \ConsoleKit\Command {
    private $help_help = <<<HELP
Wingnut is a static site generation tool. The command line script can be used to
test or publish your website.

Usage: wingnut [COMMAND] [OPTIONS]

  find <filter>
      Executes the selected filter and returns the list of discovered files.
  map <map>
      Executes the selected map and returns the formatted output.
  dryrun <publisher>
      Executes the selected publisher, publishing files to the system temp dir.
  publish <publisher>
      Executes the selected publisher and copies files to the publish directory.
  explain <filename>
      If the filename is a configuration file, explains all the currently
      defined settings in that file.
  publish-all
      Executes all publishers defined in the current configuration file.
  help
      Provides this help message. Type "wingnut help [COMMAND]" for more
      information about specific commands.
HELP;

    private $help_explain = <<<HELP
Explains all of the settings defined in the configuration file (if valid) in a
user-friendly fashion.

Usage: wingnut explain [FILENAME]

    --format=output-format
        The output format for the script. Can be one of (text|html).
    --output=output-file
        When specified, the output of this command is saved to the specified
        file.
    -t, --test
        Tests to see if the specified file is a valid configuration file.
HELP;

    private $help_find = <<<HELP
Executes the selected filter and returns the list of discovered files.

Usage: wingnut find [FILTER]

    --format=output-format
        The output format for the script. Can be one of (text|html).
    --output=output-file
        When specified, the output of this command is saved to the specified
        file.
    --config=config-file
        The configuration file where the filter is defined.
HELP;

    private $help_map = <<<HELP
Executes the selected map and returns the formatted output.

Usage: wingnut map [MAP]

    --format=output-format
        The output format for the script. Can be one of (text|html).
    --output=output-file
        When specified, the output of this command is saved to the specified
        file.
    --config=config-file
        The configuration file where the filter is defined.
HELP;

    public function execute(array $args, array $options = []) {
        if(isset($args[0])) {
            $command = $args[0];

            $help_defn = $command === 'publish-all'
                ? 'help_publish_all'
                : 'help_' . $command;

            if(isset($this->$help_defn)) {
                $this->write($this->$help_defn . "\n");
            } else {
                $this->writeln('No help found for command: ' . $command, \ConsoleKit\Colors::RED);
            }
        } else {
            $this->write($this->help_help . "\n");
        }
    }
}
