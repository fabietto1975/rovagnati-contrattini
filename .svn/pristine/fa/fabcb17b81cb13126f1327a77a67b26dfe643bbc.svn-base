<?php

namespace backend\common\rest\library;

class Request {

    public $url_elements;
    public $verb;
    public $parameters;
    public $format;
    public $datetime;
    public $httpheaders;

    public function __construct() {
        $this->verb = $_SERVER ['REQUEST_METHOD'];
        if (!isset($_SERVER ['PATH_INFO'])) {
            return null;
        }
        $this->url_elements = explode('/', $_SERVER ['PATH_INFO']);
        $this->parseIncomingParams();
        // initialise json as default format
        $this->format = 'json';
        
        /*
        if ($_FILES){
            //Fix per file uploader sotto IE8: se non si fa così l'output JSON viene trattato come file
            $this->format = 'text';
        }
         * 
         */

        if (isset($this->parameters ['format'])) {
            $this->format = $this->parameters ['format'];
        }
        // set request's datetime
        $this->datetime = $_SERVER['REQUEST_TIME'];
        
        foreach (getallheaders() as $name => $value) {
            $this->httpheaders[$name] = $value;
        }
        return true;
    }

    public function parseIncomingParams() {
        $parameters = array();

        // first of all, pull the GET vars
        if (isset($_SERVER ['QUERY_STRING'])) {
            parse_str($_SERVER ['QUERY_STRING'], $parameters);
        }

        // override what we got from GET
        $body = file_get_contents("php://input");
        $content_type = false;
        if (isset($_SERVER ['CONTENT_TYPE'])) {
            $content_type = $_SERVER ['CONTENT_TYPE'];
        }
        switch ($content_type) {
            
            case (strpos($content_type,'application/json') !== false) :
                
                // always return an array insted of an object
                $body_params = json_decode($body, true);
                if ($body_params) {
                    foreach ($body_params as $param_name => $param_value) {
                        $parameters [$param_name] = $param_value;
                    }
                }
                $this->format = "json";
                break;
            case "application/x-www-form-urlencoded":
                parse_str($body, $postvars);
                foreach ($postvars as $field => $value) {
                    $parameters [$field] = $value;
                }
                $this->format = "html";
                break;
            case (strpos($content_type,'multipart/form-data') !== false)   :
                foreach ($_POST as $field => $value) {
                    $parameters [$field] = $value;
                }
                $this->format = "html";
                break;
            default :
                // we could parse other supported formats here
                break;
        }
        if ($_FILES){
            $parameters['files'] = $_FILES;
        }


        

        $this->parameters = $parameters;
    }

}
