<?php
// generate csrf token
function generateCsrfToken(){
   if(empty($_SESSION['crsf_token'])){
    $_SESSION['crsf_token'] = bins2hex(random_bytes(32));
   }   
   return $_SESSION['crsf_token'];

   }

// verify crsf token'
function verifyCrsfToken($token){

            if (empty($_SESSION['crsf_token']) ||  empty  ($token)
                ){
            return false;
            }
              
            return hash_equal(
                $_SESSION['csrf_token'], $token
            );


            }



            //require crsf token\

    function requireCrsfToken(){

           if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            return;

           }
           
           $token= $_POST['crsf_token'] ?? '';

           //verify token 
           if(!verifyCrsfToken($token)){
            http_response_code(403);

            die('invalid CRSF token');
            
           }
    }


