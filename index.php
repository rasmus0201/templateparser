<?php
/*
Author name: Rasmus Bundsgaard Sørensen
E-mail: rasmus@it-lease.dk
Github link: https://github.com/rasmus0201/templateparser
Online link: http://rasmusbundsgaard.dk/templateparser/
*/

define('INCLUDE_PATH', 'classes');
define('TEMPLATE_PATH', 'templates');
define('RENDER_PATH', 'rendered');

//Used for performance tracking
require INCLUDE_PATH . '/ExecutionTime.php';
$time_start = microtime(true);
$executionTime = new ExecutionTime();
$executionTime->Start();


//Require class
require INCLUDE_PATH . '/TemplateParser.php';

//Placeholders as Object
$placeholders               = new stdClass();
$placeholders->title        = 'Site Title';
$placeholders->heading      = 'Frontpage';
$placeholders->text         = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, amet.';

//Placeholders as array
$placeholders = [
    'title'     => 'Site Title 2',
    'heading'   => 'Frontpage 2',
    'text'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, amet.',
];

//Template filename
$filename = 'template_1.php';

//HTML Template Path
$path = TEMPLATE_PATH . '/' . $filename;

//Make parser instance here with given template
$parser = new TemplateParser($path);

//Echo the HTML Template with given placeholders
echo $parser->render($placeholders)->asString();

//You can also echo the Class itself
echo $parser;

//This saves the parsed HTML template as a file, if needed
$parser->asFile(RENDER_PATH . '/' . $filename);

//End time
$executionTime->End();

//Find execution time (wall-clock time)
echo '<br /><br />---<br />Performance:<br />';
echo 'Total execution time: '.round((microtime(true) - $time_start)*1000, 4) .'ms';
echo '<br>'.$executionTime;
