<?php
require_once ('main.php');

try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $consulta="SELECT category * FROM category_id";
        $stmt=$conn->query($consulta);
        $category=$stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $category = $_POST["category"] ?? null;
     $name = $_POST["name"] ?? null;

     if ($category && $name) {
         $sql = "INSERT INTO Category (category, name, last_update) VALUES (:category, :name, NOW())";
         $stmt = $conn->prepare($sql);
         $stmt->execute([":category" => $category, ":name" => $name]);
         echo"Categoria registrada exitosamente";
         echo $_SERVER["REMOTE_ADDR"];
     }else{
         echo"Conectado a la base de datos";
     }
 }
 ?>


<html lang="es">
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="m-5">
<h1 class="text-center mb-5">Ejercicio 1 Examen</h1>

<form method="post" action = "" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Category</label>
        <input type="text" name="category" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">La categoria es un numero.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary">Cargar</button>
</form>
</body>











