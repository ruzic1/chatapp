<?php
    namespace controller;

    use models\UserModel;
    session_start();
    header('Content-Type:application/json');
    // $pdo=new \PDO("mysql:host=localhost;dbname=chatapp","root","");
    class LoginController extends Controller{
        //public 
        
        public function login()
        {
            $this->loadView('login');
        }
        public function loginprocessing($data){
            $model=new UserModel();
            // echo json_encode($data);
            $result=$model->retrieveHashedPassword($data['email']);
            if($result){
                $password_to_encryption=password_verify($data['password'],$result['lozinka_korisnik']);
                if($password_to_encryption){
                    $userRetrieval=$model->retrieveLoggedUser($data['email'],$result['lozinka_korisnik']);
                    if($userRetrieval){                  
                        try {
                            $_SESSION['user']=[
                                'email'=>$userRetrieval['email_korisnik'],
                                'username'=>$userRetrieval['username'],
                            ];
                            echo json_encode(['message'=>true,'description'=>"Successful login!",'user'=>$_SESSION['user']]);
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
                    echo json_encode(['message'=>false,'description'=>'Password is not right for this user.']);
                    http_response_code(400);
                }
            }else{
            }
        }
        public function registeruser($data){
            // var_dump($data);
            $model=new UserModel();
            $checkIfUserExists=$model->checkIfUserExists($data['username'],$data['email']);
            if(count($checkIfUserExists)!=0){
                // echo 'ovakav korisnik vec postoji';
                echo json_encode(false);
                http_response_code(500);
            } else {
                $registerUser=$model->registerUser($data['firstName'],$data['lastName'],$data['username'],$data['email'],$data['password']);
                echo json_encode(true);
                http_response_code(200);
            }

            // var_dump($checkIfUserExists);
        }
        public function checksession(){
            // echo json_encode(true);
            if(isset($_SESSION['user'])){
                // echo json_encode($_SESSION['user']);
                echo json_encode(['message'=>true,'user'=>$_SESSION['user']]);
            }else echo json_encode(false);
        }
        public function logout(){
            session_destroy();
            echo json_encode(['message'=>'You are successfully logged out!']);
        }
    }
?>