<?php  
  class Expense extends Base {
    function __construct($pdo) {
      $this->pdo = $pdo;
    }

    // Returns total expense amount within n days from now
    public function Expenses($UserId, $n) {
      $stmt = $this->pdo->prepare("SELECT SUM(Cost) AS TOTAL FROM expense WHERE UserId = :UserId AND DATE(`Date`) >= CURDATE() - INTERVAL :n DAY");
      $stmt->bindParam(":UserId", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":n", $n, PDO::PARAM_INT);
      $stmt->execute();
      $today = $stmt->fetch(PDO::FETCH_OBJ);
      if($today == NULL)
      {
        return NULL;
      }
      else
      return $today->TOTAL;
      }
    
    // Returns yesterday's expense amount
    public function Yesterday_expenses($UserId) {
      $stmt = $this->pdo->prepare("SELECT SUM(Cost) AS TOTAL FROM expense WHERE UserId = :UserId AND DATE(`Date`) = CURDATE() - INTERVAL 1 DAY");
      $stmt->bindParam(":UserId", $UserId, PDO::PARAM_INT);
      $stmt->execute();
      $yest = $stmt->fetch(PDO::FETCH_OBJ);
      if($yest == NULL)
      {
        return NULL;
      }
      else
      return $yest->TOTAL;
    }

    // Returns total expense amount till date
    public function totalexp($UserId) {
      $stmt = $this->pdo->prepare("SELECT SUM(Cost) AS TOTAL FROM expense WHERE UserId = :UserId");
      $stmt->bindParam(":UserId", $UserId, PDO::PARAM_INT);
      $stmt->execute();
      $total = $stmt->fetch(PDO::FETCH_OBJ);
      if($total == NULL)
      {
        return NULL;
      }
      else
      return $total->TOTAL;
    }


    // Expenses of Current Month(Datewise)
    public function Current_month_expenses($UserId) {
      $stmt = $this->pdo->prepare("SELECT EXTRACT(MONTH FROM CURRENT_TIMESTAMP()) AS CurrentMonth");
      $stmt->execute();
      $rows1 = $stmt->fetch(PDO::FETCH_OBJ);
      $val = $rows1 -> CurrentMonth;

      $stmt = $this->pdo->prepare("SELECT SUM(Cost) AS exp1 FROM expense WHERE UserId = :UserId AND MONTH(Date) = :currmon");
      $stmt->bindParam(":UserId", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":currmon", $val, PDO::PARAM_INT);
      $stmt->execute();
      $rows2 = $stmt->fetch(PDO::FETCH_OBJ);
      if($rows2 == NULL)
      {
        return NULL;
      }
      else 
      {
        return $rows2->exp1;
      }
      
    }

    // Returns expense records between 2 given dates
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

    // Returns expense records between any two given months
    public function mthwise($UserId, $FROM, $TO){
      $stmt = $this->pdo->prepare("SELECT * FROM expense WHERE (Date >= :fromdate AND Date <= (:todate + INTERVAL 1 MONTH)) AND UserId = :user ORDER BY Date ");
      $stmt->bindParam(":user", $UserId, PDO::PARAM_INT);
      $stmt->bindParam(":fromdate", $FROM, PDO::PARAM_STR); 
      $stmt->bindParam(":todate", $TO, PDO::PARAM_STR);
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
      if($rows == NULL)
      {
        return NULL;
      }
      else
      {
        return $rows;
      }
    }

    // Returns expense records(rows) between any two given years
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
    
    // Returns all rows from expense table
    public function allexp($UserId) {
      $stmt = $this->pdo->prepare("SELECT * FROM expense WHERE UserId = :UserId ORDER BY Date");
      $stmt->bindParam(":UserId", $UserId, PDO::PARAM_INT);
      $stmt->execute();
      $total = $stmt->fetchall(PDO::FETCH_OBJ);
      if($total == NULL)
      {
        return NULL;
      }
      else
      return $total;
    }

    // Returns a particular expense record(with given expense id)
    public function delexp($ID){
      $stmt = $this->pdo->prepare("DELETE FROM expense WHERE ID = :id");
      $stmt->bindParam(":id", $ID, PDO::PARAM_INT);
      $stmt->execute();
    }


  }
?>