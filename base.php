<!-- base.php -->
<?php 
  class Base {
    protected $pdo;
    
    function __construct($pdo) {
      $this->pdo = $pdo;
    }
 
    public function create($table, $fields = array()) {
      $columns = implode(',', array_keys($fields));
      $values = ':' . implode(', :', array_keys($fields));
      $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
      if ($stmt = $this->pdo->prepare($sql)) {
        foreach ($fields as $key => $data) {
          $stmt->bindValue(':'.$key, $data);
        }
        $stmt->execute();
        return $this->pdo->lastInsertId();
      }
    }
 
    public function update($table, $user_id, $fields = array()) {
      $columns = '';
      $i = 1;
      foreach ($fields as $name => $value) {
        $columns .= "{$name} = :{$name}";
        if ($i < count($fields)) {
          $columns .= ", ";
        }
        $i++;
      }
      $sql = "UPDATE {$table} SET {$columns} WHERE UserId = {$user_id}";
      if ($stmt = $this->pdo->prepare("$sql")) {
        foreach ($fields as $key => $value) {
          $stmt->bindValue(':' . $key, $value);
        }
        $stmt->execute();
      }
    }
 
    public function delete($table, $array) {
      $sql = "DELETE FROM {$table}";
      $where = " WHERE";
 
      foreach ($array as $name => $value) {
        $sql .= "{$where} {$name} = :{$name}";
        $where = " AND ";
      }
 
      if ($stmt = $this->pdo->prepare($sql)) {
        foreach ($array as $name => $value) {
          $stmt->bindValue(':'.$name, $value);
        }
      }
      $stmt->execute();
    }
  }
 
?>