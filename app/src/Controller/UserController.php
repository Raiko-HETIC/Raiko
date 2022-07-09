<?php

namespace App\Controller;
require_once('vendor/autoload.php');



use App\Entity\User;
use App\Factory\PDOFactory;
use APP\HTTP\HTTPRequest as HTTPHTTPRequest;
use App\Model\UserModel;
use App\Model\UserRoleModel;
use Firebase\JWT\Key;
use \Firebase\JWT\JWT;



class UserController extends BaseController
{
    /**
     * Login
     */

    public function executeLogin()
    {
        if ($this->HTTPRequest->isMethodAllowed('POST')) {
            $response = $this->HTTPRequest->getBasicAuthentification();
            if (is_string($response)) {
                echo($response);
            }
            else {
                //Récupération des valeurs
                $email = $response['email'];
                $password = $response['password'];

                // Check if user exist
                $userModel = new UserModel (new PDOFactory());
                $userExist = $userModel->getUserExistCheck($email);
                if (!$userExist)
                {
                    http_response_code(404);
                    $this->renderJSON("User not found");
                } else {
                    $user = $userModel->getUserByEmail($email);
                    if ($email == $user->getEmail()) {
                        if (hash('sha256', $password) == $user->getPassword()) {
                            http_response_code(200);
                            $response = array(
                                "message" => "Login successfully",
                                "jwt" => $this->generateJWT($user->getEmail())
                            );
                            $this->renderJSON($response);
                        }
                        else {
                            http_response_code(500);
                            $this->renderJSON("Password incorrect for the user");
                        }
                    } else {
                        http_response_code(500);
                        $this->renderJSON("Can't get the email of the user");
                    }
                }
            }
        }
    }


    /**
     * Register
     */
    public function executeAddUser()
    {
        if ($this->HTTPRequest->isMethodAllowed('POST')) {
            $response = $this->HTTPRequest->getBasicAuthentification();
            if (is_string($response)) {
                echo($response);
            } else {
                //Récupération des valeurs
                $email = $response['email'];
                $password = $response['password'];

                //Check des valeurs reçues
                if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
                    http_response_code(300);
                    $this->renderJSON("Invalid format for email");
                } else {
                    // Check if user exist
                    $userModel = new UserModel (new PDOFactory());
                    $userExist = $userModel->getUserExistCheck($email);
                    if ($userExist) {
                        http_response_code(409);
                        $this->renderJSON("User already exists");
                    } else {
                        $securedPassword = hash('sha256', $password);
                        $userModel = new UserModel(new PDOFactory());
                        $newUser = new User();
                        $newUser->setEmail($email);
                        $newUser->setPassword($securedPassword);
                        $newUser->setIdRole(1);
                        $newUser->setNbCreation(0);
                        $newUser->setDateInscription(date('Y-m-d H:i:s'));

                        if ($userModel->addUser($newUser)) {
                            http_response_code(201);
                            $response = array(
                                'Message' => 'Votre compte a bien été créé. Veuillez vous connecter.',
                                "JWT" => $this->generateJWT($newUser->getEmail())
                            );
                            $this->renderJSON($response);
                        }
                    }
                }
            }
        }
    }

    public function executeUserInfo()
    {
        if ($this->HTTPRequest->isMethodAllowed('GET')  && $this->HTTPRequest->isUserAllowed()) {
            $tokenInfo = $this->HTTPRequest->getJWTDetailled();

            $userModel = new UserModel (new PDOFactory());
            $userRoleModel = new UserRoleModel (new PDOFactory());
            $user = $userModel->getUserByEmail($tokenInfo->email);
            $userRole = $userRoleModel->getRoleName($user->getIdRole());

            $userInfo = array (
                'email' => $user->getEmail(),
                'date_inscription' => $user->getDateInscription(),
                'role' => $userRole->getName()
            );

            return json_encode($userInfo);
        }
    }
    

    private function generateJWT(string $email)
    {
        $key = 'DJplHnT6&1qyTa22aYu*d';
        $generatedDate = new \DateTime(); 
        $generatedDate->setTimezone(new \DateTimeZone('Europe/Paris'));

        $payload = [
            'email' => $email,
            'generateAt' =>  date_timestamp_get($generatedDate),
            'expiredAt' => strtotime('+7 day', date_timestamp_get($generatedDate))
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }

}
