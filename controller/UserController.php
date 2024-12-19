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

            if(isset($_SESSION['user_id'])){
                // echo 'Sesija je uspostavljena';
                $result=$modelInstance->chatsForUsers($_SESSION['user_id']);
                if($result){
                    echo json_encode($result);
                    http_response_code(200);
                }else{
                    echo json_encode(null);
                    http_response_code(500);
                }
            }else{
                echo json_encode("falseeeee");
                http_response_code(400);
            }
        }
        
        public function returnUserId(){
            //$modelInstance=new UserModel();
            if(isset($_SESSION['username'])){
                echo json_encode(['username'=>$_SESSION['username']]);
            }else{
                echo json_encode(['message'=>'User not logged in']);
            }
        }
    }
?>