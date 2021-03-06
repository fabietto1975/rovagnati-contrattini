<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\TokenService;

/**
 * @api {post} /rest/token (a) Richiesta token per autenticazione WS
 * @apiName Token
 * @apiGroup Token
 * 
 * @apiParam {String} username Username
 * @apiParam {String} password Password
 * 
 * @apiParamExample {json} Request-Example:
 *  {
 *      "username":"USERNAME",
 *      "password":"PASSWORD"	
 *  }
 *
 * @apiSuccess {String='success','fail'}                status                      Esito della richiesta .
 * @apiSuccess {String}                                 code                        Status code HTTP
 * @apiSuccess {String}                                 request_time                Timestamp relativo alla ricezione della richiesta.
 * @apiSuccess {String}                                 response_time               Timestamp relativo alla generazione della risposta.
 * @apiSuccess {String}                                 token                       Token da utilizzare per le autenticazioni
 * 
 * @apiSuccessExample Success-Response:
 * 
 *  {
 *      "request_time": "Tue May 31 8:48:03 CEST 2016",
 *      "code": 200,
 *      "response_time": "Tue May 31 8:48:03 CEST 2016",
 *      "status": "success"
 *      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NjQ2NzcyODMsImp0aSI6IlhnVG9ibzBsWlM4T3hnaDR0bTJaMWxGWTk3bUF2NERZbkFIanJxZVdUNGc9IiwiaXNzIjoiaHR0cDpcL1wvYXBwcy52YWx1ZWxhYi5pdCIsIm5iZiI6MTQ2NDY3NzI4MywiZXhwIjoxNDY0NzYzNjgzLCJkYXRhIjp7InVzZXJOYW1lIjoicml2YWxleCJ9fQ.ymL353UNJJdBSooOrkdDPPsfYyqp5r2ZL8sJvyfwWkzOjdxlynbIBxyCQatywBnNjuhOREyPaTXJkA5uS_kjEw"
 *  }
 * 
 * */

class TokenController extends AbstractController {

    private $tokenService;

    public function __construct($request) {
        parent::__construct($request);
        $this->tokenService = new TokenService;
    }

    public function getAction() {}

    public function postAction() {
        $parameters = $this->request->parameters;
        $res = $this->tokenService->create($parameters['username'], $parameters['password']);
        if (isset($res['error'])) {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
        } 
        $this->getResultData($res, 'token', null);
        return $this->data;
    }

    public function deleteAction() {
        
    }

    public function putAction() {
        
    }

}
