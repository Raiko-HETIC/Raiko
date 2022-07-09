<?php
namespace APP\HTTP;

use Exception;
use Firebase\JWT\Key;
use \Firebase\JWT\JWT;

class HTTPRequest
{
    private $key = 'DJplHnT6&1qyTa22aYu*d';

    public function isMethodAllowed($expectedMethod) : string|bool
    {
        $usedMethod = $_SERVER['REQUEST_METHOD'];
        if ($expectedMethod != $usedMethod) {
            http_response_code(405);
            echo('Method Not Allowed : yous send : ' . $usedMethod . ' expected method : ' . $expectedMethod);
            return false;
        } else {
            return $usedMethod;
        }
    }

    public function GetRequestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }
    
    public function getColor()
    {
        try {
            $color = json_decode(file_get_contents('php://input'));
            error_reporting(E_ALL ^ E_WARNING);
            $colorValue = $color->colorHexadecimal;
            if (!isset ($colorValue)) {
                http_response_code(404);
                return ("Fields 'colorHexadecimal' do not exist");
            } elseif (empty($colorValue)) {
                http_response_code(400);
                return ("'colorHexadecimal' is empty");
            } else {
                return $colorValue;
            }
        } catch (Exception $e) {
            return ('Exception received : '.  $e->getMessage(). "\n");
        }
    }

    public function getHeader(){
        return $_SERVER;
    }

    public function isTokenValid(string $jwt): bool
    {
        $jwt = substr($jwt, 7);
       
        try {
            // Decode and Analyse
            $JWTDecode = JWT::decode($jwt, new Key($this->key, 'HS256'));
            $expiredDate = $JWTDecode->expiredAt;
            $dateNow = new \DateTime();
            $dateNow->setTimezone(new \DateTimeZone('Europe/Paris'));
            $dateNow = date_timestamp_get($dateNow);

            // Check if it still valid
            if ($expiredDate > $dateNow)
            {
                return True;
            }
            else 
            { 
                return False;
            }
        }
        catch (\Exception $e) {
            return False;
        }
    }


    public function isUserAllowed() {
        $jwt = $_SERVER['HTTP_AUTHORIZATION'];
        $isMyTokenValid = $this->isTokenValid($jwt);
        
        
        if (!isset($jwt) or $jwt == '') {
            http_response_code(401);
            echo json_encode(array(
                'message' => 'A token is required'
            ));
            return false;
        }
        else if (!$isMyTokenValid){
            http_response_code(401);
            echo json_encode(array(
                'message' => 'Your token is not valid'
            ));
            return false;
        }
        else return true;
    }

    public function getJWTDetailled(){
        
        if ($this->isUserAllowed()) {
            $jwt = $_SERVER['HTTP_AUTHORIZATION'];
            $jwt = substr($jwt, 7);
            $jwtDetailled = JWT::decode($jwt, new Key($this->key, 'HS256'));
            return $jwtDetailled; 
        }
    }
    

    public function getBasicAuthentification()
    {
        // echo json_encode($_SERVER, JSON_PRETTY_PRINT);
        if (!isset ($_SERVER['PHP_AUTH_USER']) && !isset ($_SERVER['PHP_AUTH_PW'])) {
            http_response_code(404);
            return ('Fields password and email do not exist');
        }
        elseif (!isset ($_SERVER['PHP_AUTH_USER'])) {
            http_response_code(404);
             return('Field email does not exist');
        }
        elseif (!isset ($_SERVER['PHP_AUTH_PW'])) {
            http_response_code(404);
            return('Field password does not exist');
        }
        elseif (empty($_SERVER['PHP_AUTH_USER'])) {
            http_response_code(400);
            return('Email is empty');
        }
        elseif (empty($_SERVER['PHP_AUTH_PW'])) {
            http_response_code(400);
            return('Password is empty');
        }
        else return array(
            "email" => $_SERVER['PHP_AUTH_USER'],
            "password" =>$_SERVER['PHP_AUTH_PW'],
        );

    }
}