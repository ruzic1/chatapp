<?php
    namespace controller;

    use models\UserModel;
    session_start();


    class UserController extends Controller
    {
        public function index(){
            return $this->loadView();
        }
        public function userChats(){
            // echo 'USLO JE U PRAVU FUNKCIJU';
            // var_dump($_SESSION);
            $modelInstance=new UserModel();
            // var_dump($_SESSION['user']['email']);
            if(isset($_SESSION['user'])){
                // echo 'Sesija je uspostavljena';
                try{
                    $result=$modelInstance->chatsForUsers($_SESSION['user']['email'],$_SESSION['user']['username']);
                    if($result){
                        echo json_encode($result);
                        http_response_code(200);
                    }else{
                        echo json_encode(null);
                        http_response_code(500);
                    }
                }
                catch(Exception $e){
                    echo json_encode($e);
                }
                
                
            }else{
                echo json_encode("falseeeee");
                http_response_code(400);
            }
        }
        public function contacts(){
            $model=new UserModel();

            if(isset($_SESSION['user'])){
                $result=$model->returnUserContacts($_SESSION['user']['email'],$_SESSION['user']['username']);
                if($result){
                    echo json_encode($result);
                    http_response_code(200);
                }else{
                    echo json_encode(null);
                    http_response_code(500);
                }
            }else{
                http_response_code(400);
            }
            // $result=$model->returnUserContacts()
        }
        public function returnUserId(){
            //$modelInstance=new UserModel();
            if(isset($_SESSION['username'])){
                echo json_encode(['username'=>$_SESSION['username']]);
            }else{
                echo json_encode(['message'=>'User not logged in']);
            }
        }
        public function addContact($data){
            // var_dump($data);
            $modelInstance=new UserModel();
            $newUsername=$data['usernameOfAddedContact'];
            $loggedUser=$data['loggedUsername'];

            $result=$modelInstance->usernameOfAddedContact($newUsername,$loggedUser);
            // var_dump($result);
            // var_dump($result);
            if($result){
                echo json_encode($result);
                http_response_code(200);
            }else{
                echo json_encode(false);
                http_response_code(500);
            }
            // $modelInstance=new UserModel();
            // if()
        }
    }
?>