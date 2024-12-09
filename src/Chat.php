<?php
    //namespace App\classModels;
    namespace chat;

    
    // require_once('classModels/modelKorisnik.php');
    // require_once('kontroleri/kontrolerKorisnik.php');

    use models\UserModel;
    use controller\UserController;
    use Ratchet\MessageComponentInterface;
    use Ratchet\ConnectionInterface;
    //use PDO;
    //use App\classModels\modelKorisnik;
    //use App\classModels\modelKorisnik;

    class Chat implements MessageComponentInterface{
        protected $clients;
        public function __construct(){
            $this->clients=new \SplObjectStorage;
            // echo "Connection is establisheed!";
            // var_dump($this->clients);
        }
        public function onOpen(ConnectionInterface $conn){
            
            //echo "Connection is establisheed! {$conn->resourceId}\n";
        }
        public function onMessage(ConnectionInterface $from,$msg){

            // $msgText=json_decode($msg,true);


            // $pdo=new PDO("mysql:host=localhost;dbname=chatapp","root","");
            // $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            // $model=new modelKorisnik($pdo);
            // $kontroler=new kontrolerKorisnik($model);

            // $result=$kontroler->sendMessage($msgText);
            // var_dump($result);

            

        }
        public function onClose(ConnectionInterface $conn){

        }
        public function onError(ConnectionInterface $conn,\Exception $e){

        }
    }

?>