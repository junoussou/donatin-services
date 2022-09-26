<?php
  class Client{
    private function server($host, $dbname, $user, $pass){
      try {
        $db = new \PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8;port=3306',''.$user.'',''.$pass.'');
        $db -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $db -> setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        return $db;
      } catch (\Exception $e) {
        die('Erreur de connexion'.$e->getMessage());
      }
    }
    //user checking
    public function getUsers($table, $field, $ordre){
      $db = $this -> server('localhost', 'donatin_db', 'root', '');
      $req = $db -> query('SELECT '.$field.' FROM '.$table.' ORDER BY '.$ordre.'');
      return $req;
    }
    public function getContactUser($table, $field, $condition){
      $db = $this -> server('localhost', 'donatin_db', 'root', '');
      $req = $db -> query('SELECT '.$field.' FROM '.$table.' WHERE '.$condition.'');
      return $req;
    }
    public function getClientParAgent($table, $field, $condition, $ordre, $data){
      $db = $this -> server('localhost', 'donatin_db', 'root', '');
      $req = $db -> prepare('SELECT '.$field.' FROM '.$table.' WHERE '.$condition.' ORDER BY '.$ordre.'');
      $req -> execute($data);
      return $req;
    }
    //consultation
    public function readClient($table, $field, $ordre){
        $db = $this -> server('localhost', 'donatin_db', 'root', '');
        $req = $db -> query('SELECT '.$field.' FROM '.$table.' ORDER BY '.$ordre.'');
        return $req;
    }
    public function readMax($table, $field){
      $db = $this -> server('localhost', 'donatin_db', 'root', '');
      $req = $db -> query('SELECT MAX('.$field.') as id FROM '.$table.'');
      return $req;
    }
    //rechercher
    public function getClient($table, $field, $data){
      $db = $this -> server('localhost', 'donatin_db', 'root', '');
      $req = $db -> prepare('SELECT '.$field.' FROM '.$table.' WHERE nomPrenoms LIKE ?');
      $req -> execute(array($data));
      return $req;
      //SELECT * FROM client WHERE nomPrenoms LIKE '%abal%'
    }
    //ajout
    public function addClient($table, $field, $value, $data){
      $db = $this -> server('localhost', 'donatin_db', 'root', '');
      $req = $db->prepare('INSERT INTO '.$table.'('.$field.') VALUES('.$value.')');
      $req -> execute($data);
    }
    //suppression
    public function delClient($table, $condition, $data){
        $db = $this -> server('localhost', 'donatin_db', 'root', '');
        $req = $db -> prepare('DELETE FROM '.$table.' WHERE '.$condition.'');
        $req -> execute($data);
    }
    public function insertIntoTrash($table, $field, $value, $data){
      $db = $this -> server('localhost', 'donatin_db', 'root', '');
      $req = $db->prepare('INSERT INTO '.$table.'('.$field.') VALUES('.$value.')');
      $req -> execute($data);
    }
    //modification
    public function updateClient($table, $field, $condition, $data){
        $db = $this -> server('localhost', 'donatin_db', 'root', '');
        $req = $db -> prepare('UPDATE '.$table.' SET '.$field.' WHERE '.$condition.'');
        $req -> execute($data);
    }
    //login checking
    public function checkUser($table, $field, $condition, $data){
      $db = $this -> server('localhost', 'donatin_db', 'root', '');
      $req = $db -> prepare('SELECT '.$field.' FROM '.$table.' WHERE '.$condition.'');
      $req -> execute($data);
      return $req;
    }
    public function addUser($table, $field, $value, $data){
      $db = $this -> server('localhost', 'donatin_db', 'root', '');
      $req = $db->prepare('INSERT INTO '.$table.'('.$field.') VALUES('.$value.')');
      $req -> execute($data);
    }
    public function updateUsers($table, $field, $condition, $data){
        $db = $this -> server('localhost', 'donatin_db', 'root', '');
        $req = $db -> prepare('UPDATE '.$table.' SET '.$field.' WHERE '.$condition.'');
        $req -> execute($data);
    }
    public function getPeriode($table, $field, $date1, $date2, $data){
      $db = $this -> server('localhost', 'donatin_db', 'root', '');
      $req = $db -> prepare('SELECT '.$field.' FROM '.$table.' WHERE date BETWEEN '.$date1.' AND '.$date2.'');
      $req -> execute($data);
      return $req;
    }
    public function getPeriodeParAgent($table, $field, $date1, $date2, $agent, $data){
      $db = $this -> server('localhost', 'donatin_db', 'root', '');
      $req = $db -> prepare('SELECT '.$field.' FROM '.$table.' WHERE agent = '.$agent.' AND date BETWEEN '.$date1.' AND '.$date2.'');
      $req -> execute($data);
      return $req;
    }
  }
 ?>
