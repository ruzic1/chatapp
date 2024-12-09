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
                // if($result){
                //     var_dump($result);
                // }else{
                //     echo 'Nije vracen objekat';
                // }
            }else{
                echo json_encode("falseeeee");
                http_response_code(400);
                // echo "SESIJA  NIJE USPOSTAVLJENA";
            }
        }
        // private $modelKorisnik;
        // private $data;
        // public function __construct(modelKorisnik $korisnik){
        //     $this->modelKorisnik=$korisnik;
        // }
        // public function registration($data){
        //     //echo "ULAZI U REGISTTTRACIJU";
        //     //var_dump($data);
        //     //var_dump($data['username1']);
        //     $firstName=$data['fName1'];
        //     $lastName=$data['lName1'];
        //     $username=$data['username1']; 
        //     $email=$data['email1'];
        //     $password=$data['password1'];

        //     $errors=0;

        //     if(!preg_match("/^[A-Z][A-Za-z'-]{2,15}$/",$firstName)){
        //         $errors++;
        //     }
        //     if(!preg_match("/^[A-Za-z][A-Za-z'-]{2,20}$/",$lastName)){
        //         $errors++;
        //     }
        //     if(!preg_match("/^[a-zA-Z0-9_]{3,15}$/",$username)){
        //         $errors++;
        //     }
        //     if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$email)){
        //         $errors++;
        //     }
        //     if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",$password)){
        //         $errors++;
        //     }
            
        //     if($errors==0)
        //     {
        //         $checkIfUserExists=$this->modelKorisnik->checkIfUserExists($username,$email);
        //         //echo count($checkIfUserExists);
        //         if(count($checkIfUserExists)==0){
        //             $call=$this->modelKorisnik->registerUser($firstName,$lastName,$username,$email,$password);
                    
        //             if($call){
        //                 echo json_encode(['status'=>'success','message'=>'User created successfully!']);
        //                 http_response_code(200);
        //             }else{
        //                 echo json_encode(['status'=>'error','message'=>'Failed to create user. Try again later']);
        //                 http_response_code(500);
        //             }
        //         }else{
        //             echo json_encode(['message'=>'Username or email is already in use.']);
        //         }
        //     }

        //     //var_dump($this->modelKorisnik);
        //     //var_dump($this->modelKorisnik);
        //     //$call=$this->modelKorisnik->registerUser($data);
        //     //echo "USAO JE U REGISTRATION";
        // }
        // public function login($data){
        //     $email=$data['email'];
        //     $password=$data['password'];

        //     $retrievedEncryptedPassword=$this->modelKorisnik->retrieveHashedPassword($email)['lozinka_korisnik'];
        //     if(password_verify($password,$retrievedEncryptedPassword)){
        //         $loginUser=$this->modelKorisnik->retrieveLoggedUser($email,$retrievedEncryptedPassword);
        //         if($loginUser){
        //             $_SESSION['id_korisnik']=$loginUser['id_korisnik'];
        //             $_SESSION['username']=$loginUser['username'];

        //             echo json_encode([
        //                 "id"=>$loginUser['id_korisnik'],
        //                 "username"=>$loginUser['username'],
        //                 "success"=>true
        //             ]);
        //             http_response_code(200);
        //         }
                
        //     }else{
        //         echo("lozinke nemaju veze sa zivotom");
        //     }
        // }
        // public function returnChatsForUser($id){
        //     $users=$this->modelKorisnik->chatsForUsers($id);
        //     if($users){
        //         echo json_encode($users);
        //         http_response_code(200);
        //     }else{
        //         http_response_code(500);
        //     }
        // }
        // public function sendMessage($msg)
        // {
        //     $result=$this->modelKorisnik->sendMessageToDatabase($msg);
        //     return $result;
        // }
        
    }
?>