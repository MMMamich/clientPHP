<?php

//    Database Connection
     class Dbc {
    
         private $serverName;
         private $username;
         private $password;
         private $dbName;
         private $charset;
    
         public function connect(){
             $this->serverName = "localhost";
             $this->username   = "root";
             $this->password   = "";
             $this->dbName     = "clientDB";
             $this->charset    = "utf8mb4";
    
             //Data Source Network concatenation for PDO object
             $dsn = "mysql:host=".$this->serverName.";dbName=".$this->dbName.";charset=".$this->charset;
    
             $pdo = new PDO($dsn, $this->username, $this->password);
    
             try {
             $dsn = "mysql:host=".$this->serverName.";dbName=".$this->dbName.";charset=".$this->charset;
    
             $pdo = new PDO($dsn, $this->username, $this->password);
             //calls Sets attribute function and both args calls upon property of PDO object that show an error to the site if database is not found
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
             $pdo->query("USE clientDB");
                 
             //sql tables - chose not to make any id's auto increment due to add functionality
             $client = "DROP TABLE IF EXISTS Client; CREATE TABLE Client (
             id INT(6) UNSIGNED AUTO_INCREMENT, 
             name VARCHAR(30) NOT NULL,
             PRIMARY KEY(id)
             );";

             $sections = "DROP TABLE IF EXISTS Sections; CREATE TABLE Sections (
             id INT(6) UNSIGNED, 
             client_id INT(6) UNSIGNED,
             FOREIGN KEY (client_id) REFERENCES Client(id),
             PRIMARY KEY(id),
             name VARCHAR(30) NOT NULL
             );";

             $links = "DROP TABLE IF EXISTS Links; CREATE TABLE Links (
             id INT(6) UNSIGNED, 
             section_id INT(6) UNSIGNED,
             FOREIGN KEY(section_id) REFERENCES Sections(id),
             PRIMARY KEY(id),
             name VARCHAR(512) NOT NULL);";
            
             $pdo->exec($client);
             $pdo->exec($sections);
             $pdo->exec($links);
                 
             echo 'it worked!';
             return $pdo;
             } catch (PDOException $err) {
                 echo "Connection failed: ".$err->getMessage();
             }  
         }
        
         //id, name, (client_id/section_id/foreignKey)
         
         //Parameters is table name you wish to insert into, respective foreignKey, respective values
         public function insert($table, $id, $name, $frgnKey=null){
                 
                 $dsn = "mysql:host=".$this->serverName.";dbName=".$this->dbName.";charset=".$this->charset;
                 $pdo = new PDO($dsn, $this->username, $this->password);
                 $add = "INSERT INTO $table (id, name, $frgnKey) VALUES ($id, $name, $frgnKey)";
                 $pdo->exec($add);
                 echo ' inserted';
         }
         
         public function update($table, $id, $name, $frgnKey=null){
                 $dsn = "mysql:host=".$this->serverName.";dbName=".$this->dbName.";charset=".$this->charset;
                 $pdo = new PDO($dsn, $this->username, $this->password);
                 $change = "UPDATE $table SET id=$id, name=$name WHERE $frgnKey=client_id OR section_id)";
                 $pdo->exec($change);
                 echo ' updated';
         }
         
          public function deleteClient($table, $id, $name){
                
                 $dsn = "mysql:host=".$this->serverName.";dbName=".$this->dbName.";charset=".$this->charset;
                 $pdo = new PDO($dsn, $this->username, $this->password);
                 $destroy = "DELETE FROM $table WHERE id=$id)";
                 $pdo->exec($destroy);
                 echo ' deleted';
         }
         
         public function deleteSection($table, $id, $name, $frgnKey=null){
                
                 $dsn = "mysql:host=".$this->serverName.";dbName=".$this->dbName.";charset=".$this->charset;
                 $pdo = new PDO($dsn, $this->username, $this->password);
                 $destroy = "DELETE FROM $table WHERE $frgnKey=client_id OR section_id)";
                 $pdo->exec($destroy);
                 echo ' deleted';
         }
         
         public function deleteLink($table, $id, $name, $frgnKey=null){
                
                 $dsn = "mysql:host=".$this->serverName.";dbName=".$this->dbName.";charset=".$this->charset;
                 $pdo = new PDO($dsn, $this->username, $this->password);
                 $destroy = "DELETE FROM $table WHERE $frgnKey=client_id OR section_id)";
                 $pdo->exec($destroy);
                 echo ' deleted';
         }
         
     }

    ?>
