<?php
class Order
{
    //DB
    private $conn;
    private $table;
    public $token;

    //Order
    public $servisni_objednavka_id;
    public $datum_objednavky;
    public $stav;
    public $provozovatel_id;
    public $auto_id;

    //Detail
    public $datum_zasahu;
    public $cena;
    public $popis;
    public $typ_zasahu;
    public $servisak;
    //  public $resultArray = array();

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function checkToken()
    {
        $query = 'SELECT * FROM tokens WHERE value LIKE ? AND date_ex >= NOW()';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->token);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {

            //Set provozovatel_id
            $query = "SELECT provozovatel_id FROM tokens WHERE value LIKE ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->token);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->provozovatel_id = $row['provozovatel_id'];
            return true;
        } else {
            return false;
        }
    }
    public function createOrder()
    {

        //Create order
        $query = "INSERT INTO servisni_objednavka() VALUES(null,?,'přijato',?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->datum_objednavky);
        $stmt->bindParam(2, $this->provozovatel_id);
        $stmt->bindParam(3, $this->auto_id);
        if ($stmt->execute() === true) {
            return true;
        } else {
            return false;
        }

    }
    public function read()
    {
        //Select data
        $query = "SELECT datum as 'datum', stav as 'stav', CONCAT(znacka,' ',model) AS 'auto'
        FROM servisni_objednavka s
        INNER JOIN auto a USING(auto_id)
        WHERE s.provozovatel_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->provozovatel_id);
        $stmt->execute();
        return $stmt;

    }

    public function readHistory()
    {
        //Select data
        $query = "SELECT servisni_objednavka_id as 'id', datum as 'datum', stav as 'stav', CONCAT(znacka,' ',model) AS 'auto'
         FROM servisni_objednavka s
         INNER JOIN auto a USING(auto_id)
         WHERE s.provozovatel_id = ? AND stav LIKE'dokončeno'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->provozovatel_id);
        $stmt->execute();
        return $stmt;
    }

    public function readDetail()
    {
        $query = "SELECT datum, s.cena, popis, nazev
        FROM servisni_objednavka_radky s INNER JOIN typ_zasahu USING(typ_zasahu_id)
        WHERE servisni_objednavka_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->servisni_objednavka_id);
        $stmt->execute();
        return $stmt;
    }
}
