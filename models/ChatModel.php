<?php
    namespace models;
    class ChatModel extends Model{
        //protected $pdo

        public function messageRetrieval($username){
            //var_dump($username);
            //var_dump($username);
            $query=$this->pdo->prepare("SELECT poruka,datum FROM konekcija k1 INNER JOIN korisnik k2 ON k1.id_primalac=k2.id_korisnik OR k1.id_posiljalac=k2.id_korisnik  WHERE username=:username");
            $query->execute([
                ':username'=>$username
            ]);
            $chats=$query->fetchAll(\PDO::FETCH_ASSOC);
            return $chats;
        }

        public function insertSentMessages($sender_id,$reciever_id,$message_text){
            $query=$this->pdo->prepare("INSERT INTO konekcija(id_posiljalac,id_primalac,poruka) VALUES (:sender,:reciever,:msg)");
            $query->execute([
                ':sender'=>$sender_id,
                ':reciever'=>$reciever_id,
                ':msg'=>$message_text,
            ]);
            //$chats=$query->fetchAll(\PDO::FETCH_ASSOC);
            return $query;
        }
        //public function 
    }
?>