<?php
/**
 * Author:maywanting
 * Descript:my PDO class, sql operation more simple
 * Exception: fix the `mysql has gone away` errors.
 */

class myPDO {
    protected $db;
    protected $host;
    protected $user;
    protected $passwd;
    protected $database;
    protected $stmt;
    protected $lastQuery;
    protected $lastParams;

    public function __construct($Host, $User, $Passwd, $Database) {
        $this->host = $Host;
        $this->user = $User;
        $this->passwd = $Passwd;
        $this->database = $Database;
        $count = 0;
        while(!$this->connect() && $count < 6) {
            sleep(1);
            $count++;
        }

        if (!$this->db) {
            throw new Exception('connect fail! Please check!');
        }
    }

    public function sql($query) {
        $this->stmt = $this->db->prepare($query);
        $this->lastQuery = $query;
        return $this;
    }

    public function params($params) {
        $this->lastParams = $params;

        foreach($params as $key => $value) {
            // var_dump($value);
            if ($value[1] == 1) {
                $this->stmt->bindParam($key, $value[0], PDO::PARAM_INT);
            } else {
                $this->stmt->bindParam($key, $value[0], PDO::PARAM_STR);
            }
        }
        return $this;
    }

    public function run() {
        try {
            $this->stmt->execute();
            return $this;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 2006) {
                $count = 0;
                while ($this->connect() == false && $count < 6) {
                    sleep(1);
                    $count++;
                }

                if (!$this->connect()) {
                    return 'connect fail! Please check!';
                }
                $this->stmt = $this->db->prepare($this->lastQuery, $this->lastParams);
                $this->run();
            } else {
                throw new Exception($e->errorInfo[2]);
            }
        }
    }

    public function getResult() {
        $this->run();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function close() {
        return $this->stmt->closeCursor();
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }

    protected function connect() {
        try {
            // $dbn = "mysql:host={$this->host};chartset=utf-8;dbname={$this->database}";
            $dbn = "mysql:dbname={$this->database};host={$this->host};port=3306";
            $this->db = new PDO($dbn, $this->user, $this->passwd);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (Exception $e) {
            echo $e->errorInfo[2];
            return false;
        }
    }
}
