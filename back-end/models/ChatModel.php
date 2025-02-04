<?php
    namespace models;
    class ChatModel extends Model{
        //protected $pdo

        public function messageRetrieval($username){
            //var_dump($username);
            //var_dump($username);
            // $query=$this->pdo->prepare("SELECT poruka_id as id,poruka as message,datum FROM poruka p1 INNER JOIN korisnik k2 ON p1.id_primalac=k2.id_korisnik OR p1.id_posiljalac=k2.id_korisnik  WHERE username=:username");
            $query=$this->pdo->prepare("SELECT DISTINCT p.poruka_id as id,p.poruka as message, p.datum  FROM poruka p INNER JOIN korisnik k1 ON (p.id_primalac=k1.id_korisnik) INNER JOIN kontakt k2 ON (k1.id_korisnik=k2.korisnik_id OR k1.id_korisnik=k2.novi_kontakt_id) WHERE username=:username");
            $query->execute([
                ':username'=>$username
            ]);
            $chats=$query->fetchAll(\PDO::FETCH_ASSOC);
            return $chats;
        }

        public function insertSentMessages($sender_id,$reciever_id,$message_text){
            $query=$this->pdo->prepare("INSERT INTO poruka(id_posiljalac,id_primalac,poruka) VALUES (:sender,:reciever,:msg)");
            $success=$query->execute([
                ':sender'=>$sender_id,
                ':reciever'=>$reciever_id,
                ':msg'=>$message_text,
            ]);
            // $chats=$query->fetchAll(\PDO::FETCH_ASSOC);
            if($success){
                return true;
            }else return false;
            // return ;
        }
        public function deleteMessages($msgId){
            $query=$this->pdo->prepare("DELETE FROM poruka WHERE poruka_id=:id");
            $success=$query->execute([
                ':id'=>$msgId
            ]);
            if($success){
                return true;
            }else return false;
        }
        //public function 
    }
?>