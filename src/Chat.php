<?php
    //namespace App\classModels;
    namespace chat;

    //require_once('config.php');
    // require_once('classModels/modelKorisnik.php');
    // require_once('kontroleri/kontrolerKorisnik.php');
    require_once 'config.php';
    use models\UserModel;
    use models\ChatModel;
    use controller\UserController;
    use Ratchet\MessageComponentInterface;
    use Ratchet\ConnectionInterface;
    use ReflectionClass;
    //use PDO;
    //use App\classModels\modelKorisnik;
    //use App\classModels\modelKorisnik;

    class Chat implements MessageComponentInterface{
        protected $clients=[];
        protected $userConnections=[];
        public function __construct(){
            //$this->clients=new \SplObjectStorage;
            // echo "Connection is establisheed!";
            // var_dump($this->clients);
        }
        public function onOpen(ConnectionInterface $conn){
            $this->clients[$conn->resourceId]=$conn;
            //error_log('Connection is established and client is:'.var_dump($this->clients));
            //var_dump($this->clients->resourceId);
            //echo 'AAA';
            //$this->userConnections[]
            //echo "Connection is establisheed! {$conn->resourceId}\n";
        }
        public function onMessage(ConnectionInterface $from,$msg)
        {
            //echo serialize($from);

            // echo 'Message recieved from:'.$msg['sender_username'].PHP_EOL;
            // echo 'From Resource Id: '.$from->resourceId.PHP_EOL;

            //var_dump();
            $data=json_decode($msg,true);
            $sender=$data['sender_username'];
            $reciever=$data['reciever_username'];
            $message=$data['msg'];

            echo 'Message recieved from:'.$sender.PHP_EOL;
            echo 'From Resource Id: '.$from->resourceId.PHP_EOL;

            foreach($this->clients as $client){
                if($client!=$from){
                    $client->send($message);
                }
            }
            $model=new UserModel();
            // var_dump($model);
            // echo 'Posiljalac je '.$sender.', a primalac je '.$reciever;
            $result=$model->returnIdForSenderAndReciever($sender,$reciever);
            if($result){
                var_dump($result);
                $chatModel=new ChatModel();
                $insertMessage=$chatModel->insertSentMessages($result[0]['id_posiljalac'],$result[0]['id_primalac'],$message);
                var_dump($insertMessage);
            }else echo 'rezultat nije definisan';
            // $result=$model->returnIdForSenderAndReciever($sender,$reciever);
            //echo 'EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEKKKKKKOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO';
            //var_dump($result);
            // $reflect=new ReflectionClass($from);
            // print_r($reflect);
            //echo 'Prosledjena je poruka serveru.'.$sender;

            //var_dump($this->clients);
            //echo gettype($this->clients);
            // for($i=0;$i<count($this->clients);$i++){
            //     var_dump($this->clients[$i]);
            // }
            //echo 123;
            //var_dump($this->clients);
            //var_dump($this->clients);
            //echo $this->clients[$conn->resourceId];
            // foreach($this->clients as $client)
            // {

            // }
            //echo 'Duzina ovog niza je:'.count($this->clients);
            //$this->clients[0]->send($msg);
            // foreach($this->clients as $client){
            //     if($client!=$from){
            //         $client->send($msg);
            //     }
            // }
            // $model=new UserModel();
            // $userIDs=$model->returnIdForSenderAndReciever($sender,$reciever);
            // var_dump($userIDs);
            // var_dump($userIDs);
            //echo 'json_encode($userIDs);';
            //$result=$this->model->insertMessages()
            //echo '123';
            // var_dump($data);
            // $sender=$data['sender_username'];
            // $reciever=$data['reciever_username'];
            // $msg=$data['msg'];

            // if (isset($this->userConnections[$reciever])) {
            //     $recieverConn = $this->userConnections[$reciever];
            //     $recieverConn->send(json_encode([
            //         'sender'=>$sender,
            //         'message'=>$message,
            //     ]));
            // } else {
            //     $from->send(json_encode(['error' => 'Recipient not connected']));
            // }

            

        }
        public function onClose(ConnectionInterface $conn){
            unset($this->clients[$conn->resourceId]);
        }
        public function onError(ConnectionInterface $conn,\Exception $e){

        }
    }

?>