<?php
    namespace models;
    class UserModel extends Model{
        //protected \PDO $pdo;
        private $ime;
        private $prezime;
        private $email;
        private $lozinka;
        private $username;

        // public function __construct()
        // {
        //     $this->pdo=new \PDO("mysql:host=localhost;dbname=chatapp","root","");
        //     $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        //     $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // }
        public function checkIfUserExists($username,$email){
            $query=$this->pdo->prepare("SELECT * FROM korisnik WHERE (username=:username OR email_korisnik=:email)");
            $query->execute([
                ':username'=>$username,
                ':email'=>$email
            ]);
            $user=$query->fetchAll(\PDO::FETCH_ASSOC);
            return $user;
            //var_dump($user);
            //return $result;
            //var_dump($user);
            //return $query;
        }

        public function retrieveHashedPassword($email){
            $query=$this->pdo->prepare("SELECT lozinka_korisnik FROM korisnik WHERE email_korisnik=:email");
            $query->execute([
                ':email'=>$email
            ]);
            $user=$query->fetch(\PDO::FETCH_ASSOC);
            return $user;
        }
        public function registerUser($fName,$lName,$username,$email,$password){
            $query=$this->pdo->prepare("INSERT INTO korisnik (ime_korisnik,prezime_korisnik,username,email_korisnik,lozinka_korisnik) VALUES (:ime,:prezime,:username,:email,:lozinka)");
            $query->execute([
                ':ime'=>$fName,
                ':prezime'=>$lName,
                ':username'=>$username,
                ':email'=>$email,
                ':lozinka'=>password_hash($password,PASSWORD_BCRYPT),
            ]);
            return $query;
            //echo "AAAAAAAAAAAIJOADW";
            //var_dump($requestBody);
            //var_dump($requestBody);
            //var_dump($requestBody);
            // $query=$this->pdo->prepare("INSERT INTO korisnik (ime_korisnik,prezime_korisnik,email_korisnik,lozinka_korisnik) VALUES (:ime,:prezime,:email,:lozinka)")
            // $query->execute([
            //     ':username'=>$data['username']
            // ])
        }
        public function retrieveLoggedUser($email,$password){
            $query=$this->pdo->prepare("SELECT id_korisnik,username FROM korisnik WHERE email_korisnik=:email AND lozinka_korisnik=:password");
            $query->execute([
                ':email'=>$email,
                ':password'=>$password,
            ]);
            $user=$query->fetch(\PDO::FETCH_ASSOC);
            return $user;
        }
        public function chatsForUsers($id){
            $query=$this->pdo->prepare("SELECT k1.id_primalac,k2.username,poruka FROM konekcija k1 INNER JOIN korisnik k2 ON k1.id_primalac=k2.id_korisnik  WHERE id_posiljalac=:id ORDER BY datum DESC LIMIT 1");
            $query->execute([
                'id'=>$id
            ]);
            $chats=$query->fetchAll(\PDO::FETCH_ASSOC);
            return $chats;
        }
        public function sendMessageToDatabase($msg){
            //echo 555;
            $query=$this->pdo->prepare("INSERT INTO konekcija(id_posiljalac,id_primalac,poruka) VALUES (:sender,:reciever,:msgText)");
            var_dump($query);
            try {
                $query->execute([
                    ':sender'=>$msg['senderId'],
                    ':reciever'=>$msg['targetId'],
                    ':msgText'=>$msg['messageText']
                ]);
            } catch (\PDOException $th) {
                echo "Error:".$th;
            }
            
            //var_dump($query);
            return $query;
        }
    }

?>