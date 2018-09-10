<?php
    include_once 'clientPHP.php';
?>


<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Client DB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <h1>Michael Mamich</h1>

    <?php
    $object = new Dbc();
    $object->connect();
    
    //Methods to be called upon, params ar as follow: $table, $id, $name, $frgnKey=null
    $object->insert();
    $object->update();
    $object->deleteClient();
    $object->deleteSection();
    $object->deleteLinks();
    ?>
  
</body>
</html>