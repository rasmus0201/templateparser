<?php

/**
 * TemplateParser class for parsing a HTML template with placeholders into a complete HTML ouput.
 */
class TemplateParser {

    //Variable that holds the html template
    //Can either be a file location or a HTML string
    protected $htmlTemplate;

    //Variable that holds the parsed html string
    protected $htmlParsed;


    //Constructor is used to
    //Initialize the instance and set the template
    function __construct($htmlTemplate = '')
    {
        //Init the HTML template with supplied template
        $this->htmlTemplate = $htmlTemplate;

        //Init var to empty string
        $this->htmlParsed = '';
    }

    //Render is used to render the template with given placeholders
    public function render($placeholders){
        //Error checking
        if (!is_object($placeholders) && !is_array($placeholders)) {
            //Throw exception
            throw new \Exception('Placeholder must be type of object or array', 1);
        }

        //Check to se if we are using a file.
        //By checking to se if the htmlTemplate is a valid path and is readable,
        //Otherwise parse the template as a string
        if (!file_exists($this->htmlTemplate) || !is_readable($this->htmlTemplate)) {

            //Set buffer to HTML Template
            $bufferTemplate = $this->htmlTemplate;
        } else {
            //Include template to run PHP
            //Store the file into buffer by meens of ob_* functions

            ob_start();

            include $this->htmlTemplate;

            $bufferTemplate = ob_get_clean();
        }

        //Check to se if the placeholders var isn't empty
        if (!empty($placeholders)) {

            //Loop through placeholders
            foreach ($placeholders as $find => $replace) {

                //preg_replace function to match Regex cases
                //In this parser you have to surround your placeholders
                //with '{{' and '}}'
                //In between the brackets you can put the placeholder name,
                // and any amount of spaces to the left or right
                $bufferTemplate = preg_replace('/{{\s*'.$find.'\s*}}/', $replace, $bufferTemplate);
            }
        }

        //Set the parsed HTML template
        $this->htmlParsed = $bufferTemplate;

        //Method chaining
        return $this;
    }

    //Method which returns the parsed HTML as a string
    public function asString(){
        return $this->htmlParsed;
    }

    //Method which stores the parsed html to given location
    public function asFile($location){

        //Error catching
        try {

            //Open specified file
            $handle = fopen($location, 'w');
        } catch (\Exception $e) {

            //Throw exception
            throw new \Exception('Location must be valid location', 1);
        }

        //Write HTML template to location
        fwrite($handle, $this->htmlParsed);

        //Close handle
        fclose($handle);

        //The file was created
        return true;
    }
}
