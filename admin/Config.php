<?php

class Config
{

    public function __construct()
    {

        define('ROOT_DIR', dirname(__DIR__));
        define('admin_base_url', 'http://localhost/e-exam/admin/');
        define('student_base_url', 'http://localhost/e-exam/student/');
        define('base_url', 'http://localhost/e-exam/');
        $this->base_url = 'http://localhost/e-exam/';


        session_start();
        $_SESSION;

        $host = 'localhost';
        $db = 'e-exam';
        $user = 'root';
        $password = '';

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        $this->user_id = '';
        try {
            $this->pdo = new PDO($dsn, $user, $password);

            if ($this->pdo) {
                // echo "Connected to the $db database successfully!";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();

        }

        $this->is_auth();
    }

    public function is_auth()
    {
        if (isset($_SESSION["user_id"])) {
            $this->user_id = $_SESSION["user_id"];
            return true;
        } else {
            return false;
        }
    }

    public function check_auth()
    {
        if ($this->is_auth()) {
            return true;
        } else {
            header("location: login.php");
        }

    }

    public function insert($post, $col){
        $data = '';
        foreach ($post as $key => $value) {
            if(!empty($data)){
                $data .=",";
            }
            $data .= " `{$key}` = '{$value}' ";
        }

        
        $sql = "INSERT INTO {$col} set {$data}";
        $this->pdo->query($sql);
    }

    public function fetch_all($col){
        $sql = "SELECT * FROM {$col}";
        $this->pdo->query($sql)->fetchAll();
    }
}
?>