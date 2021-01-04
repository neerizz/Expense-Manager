<?php
    class User extends Base{
        function __construct($pdo)
        {
            $this->pdo = $pdo;
        }   

        // Removes extra space and html code from input
        public function checkInput($var)
        {
            $var = htmlspecialchars($var);
            $var = trim($var);
            $var = stripslashes($var);
            return $var;
        }

        // Logs a user in
        public function login($username, $password) 
        {
            $stmt = $this->pdo->prepare("SELECT UserId FROM user WHERE Username = :username AND Password = :password");
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $hash = md5($password);
            $stmt->bindParam(":password", $hash, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $count = $stmt->rowCount();
            
            if($count>0)
            {

                $_SESSION['UserId'] = $user->UserId;
                header("Location: templates/3-Dashboard.php");
            }
            else
            {
                return false;
            }
        }

        // Checks if email already exists
        public function checkEmail($email)
        {
            $stmt = $this->pdo->prepare("SELECT UserId FROM user WHERE Email = :email");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $count = $stmt->rowCount();
            if($count>0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // Checks if username already exists
        public function checkUsername($username)
        {
            $stmt = $this->pdo->prepare("SELECT UserId FROM user WHERE Username = :username");
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $count = $stmt->rowCount();
            if($count>0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // Returns the path of profile picture from database by user id
        public function Photofetch($UserId) {
            $stmt = $this->pdo->prepare("SELECT Photo FROM user WHERE UserId = :UserId");
            $stmt->bindParam(":UserId", $UserId, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            return $user->Photo;
        }

        
        // Logs a user out
        public function logout()
        {
            session_destroy();
            header("Location: ". BASE_URL .'index.php');
        }

        // Checks if a user is logged in
        public function loggedIn() 
        {
            if (isset($_SESSION['UserId'])) {
              return true;
            } 
            return false;
        }

        // Returns a user's entire data
        public function userData($user_id) {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE UserId = :user_id");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

    }
?>