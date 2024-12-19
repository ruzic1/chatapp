<?php
    namespace models;
    class UserModel extends Model{
        //protected \PDO $pdo;
        private $ime;
        private $prezime;
        private $email;
        private $lozinka;
        private $username;


        public function checkIfUserExists($username,$email){
            $query=$this->pdo->prepare("SELECT * FROM korisnik WHERE (username=:username OR email_korisnik=:email)");
            $query->execute([
                ':username'=>$username,
                ':email'=>$email
            ]);
            $user=$query->fetchAll(\PDO::FETCH_ASSOC);
            return $user;

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
            $query=$this->pdo->prepare('SELECT username,poruka
            FROM korisnik INNER JOIN konekcija
            ON korisnik.id_korisnik=konekcija.id_primalac OR korisnik.id_korisnik=konekcija.id_posiljalac
            WHERE id_korisnik IN (
                SELECT DISTINCT 
                    CASE 
                        WHEN id_posiljalac = :id THEN id_primalac
                        WHEN id_primalac = :id THEN id_posiljalac
                    END AS contact_id
                FROM konekcija
                WHERE id_posiljalac = :id OR id_primalac = :id
            )
            ORDER BY datum DESC LIMIT 1');

            $query->execute([
                ':id'=>$id
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
        public function returnIdForSenderAndReciever($sender,$reciever){
            try{
                $query=$this->pdo->prepare('SELECT DISTINCT id_posiljalac,id_primalac,k2.username AS sender,k3.username AS reciever FROM konekcija k1 INNER JOIN korisnik k2 ON k1.id_posiljalac=k2.id_korisnik INNER JOIN korisnik k3 ON k1.id_primalac=k3.id_korisnik WHERE (k2.username=:sender AND k3.username=:reciever) OR (k2.username=:reciever AND k3.username=:sender)');
                $query->execute([
                    ':sender'=>$sender,
                    ':reciever'=>$reciever
                ]);
                $users=$query->fetchAll(\PDO::FETCH_ASSOC);
            }
            catch(\PDOException $th){
                $users='Error:'.$th;
            }
            return $users;
        }
    }

?>