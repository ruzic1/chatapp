<?php
    namespace controller;

    use models\UserModel;
    session_start();
    // $pdo=new \PDO("mysql:host=localhost;dbname=chatapp","root","");
    class LoginController extends Controller{
        //public 
        
        public function login()
        {
            $this->loadView('login');
        }
        public function loginprocessing($data){
            $model=new UserModel();
            $result=$model->retrieveHashedPassword($data['email']);
            if($result){
                $password_to_encryption=password_verify($data['password'],$result['lozinka_korisnik']);
                if($password_to_encryption){
                    // var_dump($data['email']);
                    // var_dump($password_to_encryption);
                    $userRetrieval=$model->retrieveLoggedUser($data['email'],$result['lozinka_korisnik']);
                    //var_dump($userRetrieval);
                    //var_dump($userRetrieval);
                    if($userRetrieval){                  
                        try {
                            //$_SESSION['user_idaaaa']=$userRetrieval['id_korisnik'];
                            $_SESSION['user_id']=$userRetrieval['id_korisnik'];
                            $_SESSION['username']=$userRetrieval['username'];
                            echo json_encode(['message'=>true,'description'=>"Successful login!"]);
                            http_response_code(200);
                        } catch (\Throwable $th) {
                            echo json_encode(['message'=>false,'description'=>'Server Error:'.$th]);
                            http_response_code(500);
                        }
                    }else{
                        echo json_encode(['message'=>false,'description'=>'Something is wrong. User is not found!']);
                        http_response_code(404);
                    }
                }
                else{
                    //echo"Lozinka nema veze ni sa jednim korisnikom";
                }
            }else{
                //echo "Nepostojeci korisnik";
            }
        }
    }
?>