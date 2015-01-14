<?php

require_once 'vendor/autoload.php';

$wrapper = function($text, $render) {
    return $render->render($text);
};

$context = [
    'here' => 'World!',
    'friends' => [
        ['name' => 'Bobby'],
        ['name' => 'Julie'],
        ['name' => 'Frank']
    ],
    'karl' => $wrapper
];

$partial = <<<MUCHOPARTIAL
    Tasdingoo, {{here}}

{{#karl}}
{{here}}
{{/karl}}
MUCHOPARTIAL;

$text = <<<MUCHOGRANDE
Hello _{{here}}_
{{> troll.bagel}}

{{#friends}}
#{{name}}
{{/friends}}
MUCHOGRANDE;

$parsedown = new Parsedown();
$mustache = new Mustache_Engine();

$loader = $mustache->getPartialsLoader();
$loader->setTemplate('troll.bagel', $partial);

echo $parsedown->text($mustache->loadTemplate($text)->render($context));
