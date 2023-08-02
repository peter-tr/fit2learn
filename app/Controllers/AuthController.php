<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        echo 'error';
    }
    public function getAJAXResult(
    )
    {
        $request = $this->request;

        if ($request->isAjax()) {

            session_start();
 
            // include google API client
            #require_once "vendor/autoload.php";
            require_once APPPATH."Libraries/vendor/autoload.php";
             
            // set google client ID
            $google_oauth_client_id = "824149307833-rf7n7f39ms75cuhrq2vfkkc07nckiuds.apps.googleusercontent.com";
         
            // create google client object with client ID
            $client = new \Google_Client([
                'client_id' => $google_oauth_client_id
            ]);
         
            // verify the token sent from AJAX
            $id_token = $_POST["id_token"];
         
            $payload = $client->verifyIdToken($id_token);
            if ($payload && $payload['aud'] == $google_oauth_client_id)
            {

                #echo print_r($payload);
                // get user information from Google
                $user_google_id = $payload['sub'];
         
                $name = $payload["name"];
                $fName = $payload["given_name"];
                $lName = $payload["family_name"];
                $email = $payload["email"];
                $picture = $payload["picture"];
         
                // login the user
                $_SESSION["user"] = $user_google_id;
         
                // send the response back to client side
                echo $user_google_id . "/" . $fName . "/" . $lName . "/" . $email;

                $data["user_google_id"] = $user_google_id;
                $data['fName'] = $fName;
                $data['lName'] = $lName;
                $data["name"] = $name;
                $data["email"] = $email;
                $data["picture"] = $picture;


            }
            else
            {
                // token is not verified or expired
                echo "Failed to login.";
            }

            #https://adnan-tech.com/google-one-tap-sign-in-php-javascript/

            #echo json_encode('hello');
            #echo ('hello');
        }
    }
}
