<?php  
  class Budget extends Base {
    function __construct($pdo) {
      $this->pdo = $pdo;
    }

    // To check validity of the set budget
    public function budget_validity_checker($UserId){
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
      
      $stmt2 = $this->pdo->prepare("SELECT EXTRACT(MONTH FROM CURRENT_TIMESTAMP()) AS current");
      $stmt2->execute();
      $z = $stmt2->fetch(PDO::FETCH_OBJ);
      $val2 = $z->current;

      if($val1 === $val2)
      {
        return true;
      }
      else
      {
        return false;
      }
    }

    // To set the budget
    public function setbudget($UserId, $budget) {
      $stmt = $this->pdo->prepare("INSERT INTO budget(UserId, Budget) VALUES(:user , :amount)");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":amount", $budget, PDO::PARAM_INT);
      $stmt->execute();
    }

    // To check the current budget
    public function checkbudget($UserId) {
      $stmt = $this->pdo->prepare("SELECT Budget AS currentbudget FROM budget WHERE UserId=:user");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->execute();
      $rows = $stmt->fetch(PDO::FETCH_OBJ);
      if($rows == NULL)
      {
        return NULL;
      }
      else
      {
        return $rows->currentbudget;
      }
    }

    // To update current budget
    public function updatebudget($UserId, $budget) {
      $stmt = $this->pdo->prepare("UPDATE budget SET Budget = :amount, RDATE = CURRENT_TIMESTAMP() WHERE UserId = :user");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":amount", $budget, PDO::PARAM_INT);
      $stmt->execute();
    }
    
    // To delete the monthly budget record (Once the month changes)
    public function del_budget_record($UserId){
      $stmt = $this->pdo->prepare("DELETE FROM budget WHERE UserId = :user");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->execute();
    }


  }
?>