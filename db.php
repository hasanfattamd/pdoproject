<?php
class DB{
    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbpassword = "mysql";
    private $dbname = "namesdb";
    private $conn;

    public function __construct(){
        try{
            //$dsn = "mysql:host=localhost;dbname=namesdb";
            $dsn = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $this->conn = new PDO($dsn, $this->dbuser, $this->dbpassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection Failed" . $e->getMessage();
        }
    }

    public function insertData($name){
        $sql = "INSERT INTO names(name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        $insert_data = ['name' => $name];
        $stmt->execute($insert_data);
    }

    public function getData(){
        $sql = "SELECT * FROM names";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

    public function deleteData($id){
        $sql = "DELETE FROM names WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

    }
    public function editData($id, $name){
        $sql = "UPDATE names SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id, 'name' => $name]);
    }
    public function searchData($name){
        $sql = "SELECT * FROM names WHERE name LIKE :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => '%' . $name . '%']);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}

?>
