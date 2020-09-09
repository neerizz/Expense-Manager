<?php  
  class Expense extends Base {
    function __construct($pdo) {
      $this->pdo = $pdo;
    }

    public function EXPENSES($UserId, $n) {
      $stmt = $this->pdo->prepare("SELECT SUM(Cost) AS TOTAL FROM expense WHERE UserId = :UserId AND DATE(`Date`) >= CURDATE() - INTERVAL :n DAY");
      $stmt->bindParam(":UserId", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":n", $n, PDO::PARAM_INT);
      $stmt->execute();
      $tod = $stmt->fetch(PDO::FETCH_OBJ);
      if($tod == NULL)
      {
        return NULL;
      }
      else
      return $tod->TOTAL;
      }

    public function Yesterday($UserId) {
      $stmt = $this->pdo->prepare("SELECT SUM(Cost) AS TOTAL FROM expense WHERE UserId = :UserId AND DATE(`Date`) = CURDATE() - INTERVAL 1 DAY");
      $stmt->bindParam(":UserId", $UserId, PDO::PARAM_INT);
      $stmt->execute();
      $yes = $stmt->fetch(PDO::FETCH_OBJ);
      if($yes == NULL)
      {
        return NULL;
      }
      else
      return $yes->TOTAL;
    }

    public function totalexp($UserId) {
      $stmt = $this->pdo->prepare("SELECT SUM(Cost) AS TOTAL FROM expense WHERE UserId = :UserId");
      $stmt->bindParam(":UserId", $UserId, PDO::PARAM_INT);
      $stmt->execute();
      $tot = $stmt->fetch(PDO::FETCH_OBJ);
      if($tot == NULL)
      {
        return NULL;
      }
      else
      return $tot->TOTAL;
    }


    //Expenses of current Month
    public function thismonth($UserId) {
      $stmt = $this->pdo->prepare("SELECT EXTRACT(MONTH FROM CURRENT_TIMESTAMP()) AS x1");
      $stmt->execute();
      $tot = $stmt->fetch(PDO::FETCH_OBJ);
      $val = $tot -> x1;

      $stmt = $this->pdo->prepare("SELECT SUM(Cost) AS qq FROM expense WHERE UserId = :UserId AND MONTH(Date) = :pp");
      $stmt->bindParam(":UserId", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":pp", $val, PDO::PARAM_INT);
      $stmt->execute();
      $tota = $stmt->fetch(PDO::FETCH_OBJ);
      if($tota == NULL)
      {
        return NULL;
      }
      else 
      {
        return $tota->qq;
      }
      
    }


    public function dtwise($UserId, $FROM, $TO){
      $stmt = $this->pdo->prepare("SELECT * FROM expense WHERE (Date >= :fromdate AND Date <= (:todate + INTERVAL 1 DAY)) AND UserId = :user ORDER BY Date");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":fromdate", $FROM, PDO::PARAM_STR); 
      $stmt->bindParam(":todate", $TO, PDO::PARAM_STR);
      $stmt->execute();
      $dt = $stmt->fetchAll(PDO::FETCH_OBJ);
      if($dt == NULL)
      {
        return NULL;
      }
      else
      {
        return $dt;
      }
    }

    public function mthwise($UserId, $FROM, $TO){
      $stmt = $this->pdo->prepare("SELECT * FROM expense WHERE (Date >= :fromdate AND Date <= (:todate + INTERVAL 1 MONTH)) AND UserId = :user ORDER BY Date ");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":fromdate", $FROM, PDO::PARAM_STR); 
      $stmt->bindParam(":todate", $TO, PDO::PARAM_STR);
      $stmt->execute();
      $dt = $stmt->fetchAll(PDO::FETCH_OBJ);
      if($dt == NULL)
      {
        return NULL;
      }
      else
      {
        return $dt;
      }
    }

    public function yrwise($UserId, $FROM, $TO){
      $stmt = $this->pdo->prepare("SELECT * FROM expense WHERE (EXTRACT(year FROM Date) >= :fromdate AND EXTRACT(year FROM Date) <= (:todate)) AND UserId = :user ORDER BY Date");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":fromdate", $FROM, PDO::PARAM_STR); 
      $stmt->bindParam(":todate", $TO, PDO::PARAM_STR);
      $stmt->execute();
      $dt = $stmt->fetchAll(PDO::FETCH_OBJ);
      if($dt == NULL)
      {
        return NULL;
      }
      else
      {
        return $dt;
      }
    }
    
    public function allexp($UserId) {
      $stmt = $this->pdo->prepare("SELECT * FROM expense WHERE UserId = :UserId ORDER BY Date");
      $stmt->bindParam(":UserId", $UserId, PDO::PARAM_INT);
      $stmt->execute();
      $tot = $stmt->fetchall(PDO::FETCH_OBJ);
      if($tot == NULL)
      {
        return NULL;
      }
      else
      return $tot;
    }

    public function delexp($ID){
      $stmt = $this->pdo->prepare("DELETE FROM expense WHERE ID = :id");
      $stmt->bindParam(":id", $ID, PDO::PARAM_INT);
      $stmt->execute();
    }


  }
?>