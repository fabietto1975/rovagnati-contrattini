<?php

namespace backend\common\rest\views;

use backend\common\rest\controllers\AbstractController;

class JsonView {

    public function render($content) {
        $status = 200;
        if (isset($content['code'])){
            $status = $content['code'];
        }
        header('Content-Type: application/json; charset=utf8');
        header("HTTP/1.1 " . $status . " " .AbstractController::_requestStatus($status));
        header("Access-Control-Allow-Origin: *"); //FOR CORSheader('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: x-requested-with');
        
        
        echo trim(json_encode($content, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT  ));
        return true;
    }
}