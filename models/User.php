<?php
class User
{

    //DB
    private $conn;
    private $table = "provozovatel";

    //User
    public $provozovatel_id;
    public $email;
    public $password;
    public $token;
    //Con DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Login
    public function login()
    {
        $query = 'SELECT provozovatel_id,email FROM ' . $this->table . ' WHERE email LIKE ? AND password LIKE ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->password);

        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->provozovatel_id = $row['provozovatel_id'];

            return true;
        } else {
            return false;
        }

    }

    public function checkToken()
    {
        $query = 'SELECT * FROM tokens
        WHERE value LIKE
        (SELECT value FROM tokens WHERE provozovatel_id = ?)
        AND date_ex >= NOW()';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->provozovatel_id);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            return true;
        } else {
            // $query = "DELETE FROM tokens WHERE value LIKE ? AND provozovatel_id = ?";
            // $stmt = $this->conn->prepare($query);
            // $stmt->bindParam(1, $token);
            // $stmt->bindParam(2, $this->provozovatel_id);
            // $stmt->execute();
            return false;
        }

    }

    public function createToken()
    {
        //Create token
        $hash = hash('sha256', random_bytes(64));
        //Check
        $query = "SELECT * FROM tokens WHERE value LIKE ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $hash);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            $this->createToken();
        } else {
            //Set token
            $this->token = $hash;

            //Insert token to DB

        }

    }
}
