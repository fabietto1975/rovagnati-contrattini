<?php

namespace backend\common\rest\controllers;

abstract class AbstractController {

    const HTTP_CODE_OK = 200;
    const HTTP_CODE_BADREQUEST = 400;
    const HTTP_CODE_UNAUTHORIZED = 401;
    const HTTP_CODE_NOTFOUND = 404;
    const HTTP_CODE_NOTALLOWED = 405;
    const HTTP_CODE_UNPROCESSABLE = 422;
    const HTTP_CODE_INTERNAL_SERVER_ERROR = 500;

    protected $data;
    protected $request;

    public static function _requestStatus($code) {
        $status = array(
            AbstractController::HTTP_CODE_OK => 'OK',
            AbstractController::HTTP_CODE_BADREQUEST => 'Bad Request',
            AbstractController::HTTP_CODE_UNAUTHORIZED => 'Unauthorized',
            AbstractController::HTTP_CODE_NOTFOUND => 'Not Found',
            AbstractController::HTTP_CODE_NOTALLOWED => 'Method Not Allowed',
            AbstractController::HTTP_CODE_UNPROCESSABLE => 'Unprocessable Entity',
            AbstractController::HTTP_CODE_INTERNAL_SERVER_ERROR => 'Internal Server Error'
                
        );
        return ($status[$code]) ? $status[$code] : $status[500];
    }

    public abstract function getAction();

    public abstract function postAction();
    
    public abstract function putAction();
    
    public abstract function deleteAction();

    public function __construct($request) {
        $this->request = $request;
        $this->data ['request_time'] = date("D M j G:i:s T Y", $this->request->datetime);
        $this->data['code'] = 200;
    }

    protected function getResultData($result, $entity, $message) {
        include(APP_ROOT . '/config/config-local.php');
        $this->data['response_time'] = date("D M j G:i:s T Y");
        $this->data['version_number'] = $version['number'];
        if ($result === null || array_key_exists('error', $result)) {
            $this->data ['status'] = "fail";
           
            if ($message != null) {
                $this->data ['message'] = $message ;
            }
            
            if (array_key_exists('error', $result)) {
                $this->data ['error'] = $result['error'];
            }
            
        } else {
            $this->data ['status'] = "success";
            //$this->data['itemCount'] = count($result);
            $this->data [$entity] = $result['res'];
        }
    }
    
    public function getRequest() {
        return $this->request;
    }
    
    public function getData() {
        return $this->data;
    }

    public function setData($key, $value) {
        $this->data[$key] = $value;
    }

}
