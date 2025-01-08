<?php
class Database {
    private $pdo;
    public function __construct() {
        $host = "localhost";
        $db = "noithat";
        $user = "Duy";
        $pass = "Duy01032003!";

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";

        //try {
            $this->pdo = new PDO($dsn, $user, $pass);
        //     echo "Connected successfully. </br>";
        // } catch(PDOException $ex) {
        //     echo $ex->getMessage();
        // }
    }

    public function prepareAndExecute($sql, $data = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }

    public function getAllData($table) {
        $sql = "SELECT * FROM $table";
        $stmt = $this->prepareAndExecute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public function insert($table, $data) {
        $fields = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $this->pdo->exec("SET NAMES utf8");
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        return $this->prepareAndExecute($sql, $data);
    }
    
    public function update($table, $data, $conditions = '') {
        $updateFields = '';
        foreach ($data as $key => $value) {
            $updateFields .= "$key = :$key, ";
        }
        $updateFields = rtrim($updateFields, ', ');
        $this->pdo->exec("SET NAMES utf8");
        $sql = "UPDATE $table SET $updateFields" . (!empty($conditions) ? " WHERE $conditions" : '');
        return $this->prepareAndExecute($sql, $data);
    }
    public function delete($table, $conditions = '', $data = []) {
        $sql = "DELETE FROM $table " . (!empty($conditions) ? " WHERE $conditions" : '');
        return $this->prepareAndExecute($sql, $data);
    }
    
    public function getRows($sql, $data = [], $singleRow = false) {
        $stmt = $this->prepareAndExecute($sql, $data);
        if ($singleRow) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function countRows($sql, $data = []) {
        $stmt = $this->prepareAndExecute($sql, $data); 
        return $stmt->rowCount();
    }
    public function getLimitedRows($table, $limit, $offset) {
        $sql = "SELECT * FROM $table LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
