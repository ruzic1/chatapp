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
            $query=$this->pdo->prepare("SELECT id_korisnik,username,email_korisnik FROM korisnik WHERE email_korisnik=:email AND lozinka_korisnik=:password");
            $query->execute([
                ':email'=>$email,
                ':password'=>$password,
            ]);
            $user=$query->fetch(\PDO::FETCH_ASSOC);
            return $user;
        }
        public function returnUserContacts($email,$username){
            // SELECT DISTINCT username,poruka,datum 
            // FROM poruka p1 
            // INNER JOIN korisnik k2 
            // ON p1.id_posiljalac=k2.id_korisnik OR p1.id_primalac=k2.id_korisnik 
            // WHERE k2.id_korisnik!=(SELECT korisnik.id_korisnik FROM korisnik WHERE email_korisnik=:email AND username=:username) AND p1.datum=(SELECT MAX(poruka.datum) FROM poruka WHERE (poruka.id_posiljalac=k2.id_korisnik OR poruka.id_primalac=k2.id_korisnik))
            $query=$this->pdo->prepare('SELECT k1.*,k2.* FROM korisnik k1 INNER JOIN kontakt k2 ON k1.id_korisnik = k2.novi_kontakt_id WHERE k2.korisnik_id=(SELECT id_korisnik FROM korisnik WHERE email_korisnik=:email AND username=:username)');
        

            $query->execute([
                ':email'=>$email,
                ':username'=>$username
            ]);
            $chats=$query->fetchAll(\PDO::FETCH_ASSOC);
            return $chats;
        }
        public function chatsForUsers($email,$username){
            $query=$this->pdo->prepare('SELECT DISTINCT p2.id_primalac,poruka FROM korisnik k1 
            INNER JOIN poruka p2 ON k1.id_korisnik=p2.id_primalac OR k1.id_korisnik=p2.id_posiljalac 
            WHERE p2.id_posiljalac=(SELECT id_korisnik FROM korisnik WHERE email_korisnik=:email AND username=:username) OR p2.id_primalac=(SELECT id_korisnik FROM korisnik WHERE email_korisnik=:email AND username=:username)');
            
            // $query=$this->pdo->prepare('SELECT username,poruka
            // FROM korisnik INNER JOIN konekcija
            // ON korisnik.id_korisnik=konekcija.id_primalac OR korisnik.id_korisnik=konekcija.id_posiljalac
            // WHERE id_korisnik IN (
            //     SELECT DISTINCT 
            //         CASE 
            //             WHEN id_posiljalac = :id THEN id_primalac
            //             WHEN id_primalac = :id THEN id_posiljalac
            //         END AS contact_id
            //     FROM konekcija
            //     WHERE id_posiljalac = :id OR id_primalac = :id
            // )
            // ORDER BY datum DESC LIMIT 1');

            // $query->execute([
            //     ':id'=>$id
            // ]);
            $query->execute([
                ':email'=>$email,
                ':username'=>$username
            ]);
            $chats=$query->fetchAll(\PDO::FETCH_ASSOC);
            return $chats;
        }
        public function sendMessageToDatabase($msg){
            //echo 555;
            $query=$this->pdo->prepare("INSERT INTO poruka(id_posiljalac,id_primalac,poruka) VALUES (:sender,:reciever,:msgText)");
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
                $query=$this->pdo->prepare('SELECT DISTINCT id_posiljalac,id_primalac,k2.username AS sender,k3.username AS reciever FROM poruka p1 INNER JOIN korisnik k2 ON p1.id_posiljalac=k2.id_korisnik INNER JOIN korisnik k3 ON p1.id_primalac=k3.id_korisnik WHERE (k2.username=:sender AND k3.username=:reciever) OR (k2.username=:reciever AND k3.username=:sender)');
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
        public function usernameOfAddedContact($newUsername,$loggedUser){
            $query=$this->pdo->prepare("SELECT * FROM korisnik WHERE username=:username");
            $query->execute([
                ':username'=>$newUsername
            ]);
            $count=$query->fetchAll(\PDO::FETCH_ASSOC);
            // var_dump(count($count));
            if(count($count)!=0){
                // return "Username exists, so we can keep with code";
                $convertToId=$this->pdo->prepare("SELECT MAX(CASE WHEN username = :username THEN id_korisnik END) AS id_korisnik1,MAX(CASE WHEN username = :otherUsername THEN id_korisnik END) AS id_korisnik2 FROM korisnik WHERE username IN (:username, :otherUsername)");
                $convertToId->execute([
                    ':username'=>$loggedUser,
                    ':otherUsername'=>$newUsername
                ]);
                $result=$convertToId->fetchAll(\PDO::FETCH_ASSOC);
                
                if($result){
                    $newQuery=$this->pdo->prepare("INSERT IGNORE INTO kontakt (korisnik_id, novi_kontakt_id) VALUES (:korisnik, :novi_kontakt);");
                    
                    $success=$newQuery->execute([
                        ':korisnik'=>$result[0]['id_korisnik1'],
                        ':novi_kontakt'=>$result[0]['id_korisnik2']
                    ]);

                    if($newQuery->rowCount()>0){
                        return[
                            'success'=>true,
                            'message'=>"Contact is successfully added!"
                        ];
                    }else{
                        return[
                            'success'=>false,
                            'message'=>"Error: user contact is already added!"
                        ];
                    };
                        
                }
                // $newQuery=$this->pdo->prepare("INSERT INTO kontakt(korisnik_id,novi_kontakt_id) VALUES(:korisnik,:novi_kontakt)");
                // $newQuery->execute([
                //     ':korisnik'=>$loggedUser,
                //     ':novi_kontakt'=>$newUsername
                // ]);
                // $newResult=$newQuery->fetchAll(\PDO::FETCH_ASSOC);
                // if($newResult){
                //     return "Contact is successfully added";

                // }else{
                //     return "Server error. Try again later";
                // }
            }
            else{
                return [
                    'success'=>false,
                    'message'=>"User doesn't exist!"
                ];
            }

        }
    }

?>