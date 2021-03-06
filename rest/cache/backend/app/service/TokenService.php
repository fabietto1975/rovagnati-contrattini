<?php

namespace backend\app\service;

use backend\app\dao\TokenDAO;
use Firebase\JWT\JWT;

class TokenService {

    private $tokenDAO;

    public function __construct() {
        $this->tokenDAO = new TokenDAO();
    }

    public function create($username, $password) {
        include \Go\Instrument\Transformer\FilterInjectorTransformer::rewrite((APP_ROOT . '/config/config-local.php'), 'D:\xampp-5.6.3\htdocs\rilevazioni\backend\app\service');
        $res = $this->tokenDAO->check($username, $password);
        $credentialsValid = ($res == 'OK');
        if ($credentialsValid) {
            //Generazione token secondo le specifiche JWT
            $tokenId = base64_encode(mcrypt_create_iv(32)); //Random ID
            $issuedAt = time();
            $expire = $issuedAt + $token['durata'];
            $serverKey = base64_decode($token['serverKey']);
            $data = [
                'iat' => $issuedAt, 
                'jti' => $tokenId, 
                'iss' => $token['issuer'], 
                'nbf' => $issuedAt, 
                'exp' => $expire, 
                'data' => [                  
                    'userName' => $username
                ]
            ];
            $jwt = JWT::encode(
                $data, 
                $serverKey, 
                'HS512'     
            );
            return array(
                'res' => $jwt,
                'status' => 'success',
                
            );
          
            
        } else {
            return array(
                'status' => 'fail',
                'message' => 'credenziali non valide',
                'error' => 'INVALID_LOGIN'
            );
        }
    }

}
