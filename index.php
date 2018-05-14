<?php
/*
Author name: Rasmus Bundsgaard Sørensen
Github link: https://github.com/rasmus0201
*/

//Used for performance tracking
require 'resources/ExecutionTime.php';
$time_start = microtime(true);
$executionTime = new ExecutionTime();
$executionTime->Start();


//Require class
require 'resources/TemplateParser.php';

//Placeholders as Object
$placeholders = new stdClass();
$placeholders->title = 'Site Title';
$placeholders->heading = 'Frontpage';
$placeholders->text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, amet.';

//Placeholders as array
$placeholders = [
    'title'     => 'Site Title 2',
    'heading'   => 'Frontpage 2',
    'text'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, amet.',
];

//HTML Template Path
$path = 'templates/template_1.php';

//Make parser instance here with given template
$parser = new TemplateParser($path);

//Echo the HTML Template with given placeholders
echo $parser->render($placeholders)->asString();

//This saves the parsed HTML template as a file, if needed
$parser->asFile('rendered/template_1.php');

//End time
$executionTime->End();

//Find execution time (wall-clock time)
echo '<br /><br />---<br />Performance:<br />Total execution time: '.round((microtime(true) - $time_start)*1000, 4) .'ms';
echo '<br>'.$executionTime;
