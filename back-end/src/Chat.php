<?php
    //namespace App\classModels;
    namespace chat;

    //require_once('config.php');
    // require_once('classModels/modelKorisnik.php');
    // require_once('kontroleri/kontrolerKorisnik.php');
    require_once __DIR__ . '/../config.php';
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
        public function __construct()
        {
            //$this->clients=new \SplObjectStorage;
            // echo "Connection is establisheed!";
            // var_dump($this->clients);
        }
        public function onOpen(ConnectionInterface $conn)
        {

            // $username=$this->getUserConnectionByUsername($conn);
    
            // You can store additional information, such as the username, here.
            $this->clients[$conn->resourceId] = [
                'connection' => $conn,
                'username' => null // Username will be set later from client-side
            ];
            echo "New connection: (Resource ID: {$conn->resourceId})\n";
            // $message=json_decode($conn->receive());
            // var_dump($message);
            // $this->clients[$conn->resourceId]=[
            //     'connection'=>$conn,
            //     'username'=>null
            // ];
            //error_log('Connection is established and client is:'.var_dump($this->clients));
            //var_dump($this->clients->resourceId);
            //echo 'AAA';
            //$this->userConnections[]
            //echo "Connection is establisheed! {$conn->resourceId}\n";
        }
        public function onMessage(ConnectionInterface $from,$msg)
        {
            echo "Message recieved on backend: $msg\n";

            $data=json_decode($msg,true);
            if(isset($data['username'])){
                // echo 'setovan je username jebogaja';
                $this->clients[$from->resourceId]['username']=$data['username'];
                echo "Username set for Resource ID {$from->resourceId}: {$data['username']}\n";
                return; 
            }
            if(isset($data['sender_username'],$data['recipient_username'],$data['message'])){
                $senderUsername = $data['sender_username'];
                $recipientUsername = $data['recipient_username'];
                $message = $data['message'];

                // Find the recipient's connection
                // foreach($this->clients as $client){
                //     if($client['username']==$recipientUsername){
                //         echo 'KONACNO SU ISTI SVE IM JEBEM';
                //     }else echo 'opet nisu isti';
                    
                // }
                // foreach($this->clients as $client){
                //     if($client['username']==$recipientUsername){
                //         echo 'KONACNO SU ISTI SVE IM JEBEM';
                //     }else echo 'opet nisu isti';
                // }
                $model=new UserModel();
                $result=$model->returnIdForSenderAndReciever($data['sender_username'],$data['recipient_username']);
                if($result){
                    $chatModel=new ChatModel();
                    $insertMessage=$chatModel->insertSentMessages($result[0]['id_posiljalac'],$result[0]['id_primalac'],$data['message']);
                    if($insertMessage){
                        $recieverConnection=$this->getUserConnectionByUsername($recipientUsername);
                        if($recieverConnection){
                            $recieverConnection->send(json_encode([
                                'sender'=>$senderUsername,
                                'message'=>$message
                            ]));
                        }else{
                            echo 'Recipient is offline';
                            //Functionality for when recipient is not in the chat 
                        }
                    }
                }else echo 'Something is wrong';



                // $recipientConnection = $this->getUserConnectionByUsername($recipientUsername);
                // if($recipientConnection){
                //     echo 'KONACNO SU ISTI SVE IM JEBEM';
                //     $recipientConnection->send(json_encode([
                //         'sender'=>$senderUsername,
                //         'message'=>$message
                //     ]));
                // }else{
                //     echo 'opet nisu isti';
                // }
                // var_dump($this->clients[]['username']);
                // if($recipientConnection){
                //     echo 'KONEKTOVAN JE DEBIL';
                // }else echo "Recipient {$recipientUsername} is not connected";
            }
            // var_dump($msg);
            // if(isset($data['username'])){
            //     var_dump($data);
            // }
            // if(isset($data['sender_username'],$data['recipient_username'],$data['message'])){
            //     echo 'ISPOSTOVAN JE USLOV';

            //     $recipientConnection = $this->getUserConnectionByUsername($data['recipient_username']);
            //     if($recipientConnection){
            //         echo 'RECIPIENT IS FOUND';
            //     }else echo 'Recipient not found';
            // }
            // $data=json_decode($msg,true);
            // if(isset($data['sender_username'])){
            //     $this->clients[$from->resourceId]['username']=$data['sender_username'];
            // }


            // if(isset($data['sender_username'],$data['message'])){
            //     $model=new UserModel();
            //     $result=$model->returnIdForSenderAndReciever($data['sender_username'],$data['recipient_username']);
            //     if($result){
            //         $chatModel=new ChatModel();
            //         $insertMessage=$chatModel->insertSentMessages($result[0]['id_posiljalac'],$result[0]['id_primalac'],$data['message']);
            //         if($insertMessage){
            //             $recieverConnection=$this->getUserConnectionByUsername($data['recipient_username']);
            //             if($recieverConnection){
            //                 $recieverConnection->send(json_encode([
            //                     'from'=>$data['sender_username'],
            //                     'message'=>$data['message']
            //                 ]));
            //             }else{
            //                 echo 'Recipient is offline';
            //                 //Functionality for when recipient is not in the chat 
            //             }
            //         }
            //     }
            // }
            // $from->sender=$data['sender_username'];
            // $from->reciever=$data['recipient_username'];
            // $from->message=$data['message'];


            // $sender=$data['sender_username'];
            // $reciever=$data['recipient_username'];
            // $message=$data['message'];



            

        }
        private function getUserConnectionByUsername($recipient){
            // var_dump($this->clients);
            // echo 'ulazi u funkciju i vrednost je:'.$recipient;
            // var_dump($recipient);
            foreach($this->clients as $client){
                // echo "if($client['username']==$recipient)"
                // var_dump($client['username']);
                // if($client['username']) echo($client['username']);
                // echo $client['username'];
                if($client['username']==$recipient){
                    // echo 'isti su';
                    return $client['connection'];
                }
                // }else return null;
                // // echo gettype($client['username']);
                
                // echo gettype($recipient);
                // var_dump($client['username']);
                // var_dump($client['username']);
                // var_dump($client);
                // if($client['username']==$recipient){
                //     echo 'TACNOOOO JE';
                // }else echo 'NIJE TACNO MAJKE MU GA NABIJEM';
            }
            // return null;
        }
        public function onClose(ConnectionInterface $conn){
            unset($this->clients[$conn->resourceId]);
        }
        public function onError(ConnectionInterface $conn,\Exception $e){

        }
    }

?>