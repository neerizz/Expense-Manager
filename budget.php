<?php  
  class Budget extends Base {
    function __construct($pdo) {
      $this->pdo = $pdo;
    }

    public function checker($UserId){
      $stmt = $this->pdo->prepare("SELECT EXTRACT(MONTH FROM RDATE) AS mon FROM budget WHERE UserId = :user");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->execute();
      $r = $stmt->fetch(PDO::FETCH_OBJ);
      if($r == NULL)
      {
        return true;
      }
      else
      {
        $val1 = $r->mon;
      }
      
      $stmt2 = $this->pdo->prepare("SELECT EXTRACT(MONTH FROM CURRENT_TIMESTAMP()) AS qwe");
      $stmt2->execute();
      $z = $stmt2->fetch(PDO::FETCH_OBJ);
      $val2 = $z->qwe;

      if($val1 === $val2)
      {
        return true;
      }
      else
      {
        return false;
      }
    }

    public function setbudget($UserId, $budget) {
      $stmt = $this->pdo->prepare("INSERT INTO budget(UserId, Budget) VALUES(:user , :paisa)");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":paisa", $budget, PDO::PARAM_INT);
      $stmt->execute();
      }

    public function checkbudget($UserId) {
      $stmt = $this->pdo->prepare("SELECT Budget AS re FROM budget WHERE UserId=:user");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->execute();
      $sau = $stmt->fetch(PDO::FETCH_OBJ);
      if($sau == NULL)
      {
        return NULL;
      }
      else
      {
        return $sau->re;
      }
      }

    public function updatebudget($UserId, $budget) {
      $stmt = $this->pdo->prepare("UPDATE budget SET Budget = :paisa, RDATE = CURRENT_TIMESTAMP() WHERE UserId = :user");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":paisa", $budget, PDO::PARAM_INT);
      $stmt->execute();
      }
    
    public function delrecord($UserId){
      $stmt = $this->pdo->prepare("DELETE FROM budget WHERE UserId = :user");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->execute();
    }


  }
?>