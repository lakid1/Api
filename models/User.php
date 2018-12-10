<?php
class User
{

    //DB
    private $conn;
    private $table = "provozovatel";

    //User
    public $provozovatel_id;
    public $email;
    public $heslo;
    public $token;
    //Con DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Login
    public function login()
    {
        $query = 'SELECT provozovatel_id,email FROM ' . $this->table . ' WHERE email LIKE ? AND heslo LIKE ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(1, $this->heslo);

        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->provozovatel_id = $row['provozovatel_id'];

            return true;
        } else {
            return false;
        }

    }

    public function tokenExpire($token)
    {
        $query = 'SELECT * FROM tokens WHERE value LIKE ? AND date_ex >= NOW()';

        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $token);

        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            return true;
        } else {
            $query = "DELETE FROM tokens WHERE value LIKE ?";
            $stmt = $conn->prepare();
            $stmt->bindParam(1, $token);
            $stmt->execute();
            return false;
        }

    }

    public function createToken()
    {   

        $this->token = hash('sha256',random_bytes(100));
        //Check
    }
}
