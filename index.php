<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>exercice sql</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php // include 'connection.php'; ?>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "exercise-sql";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }


    $sql = "SELECT first_name, last_name FROM `table 1` WHERE last_name = 'palmer'";

    echo "<div class='container'>
      <table class='table table-hover table-striped'>
      <caption> Afficher tous les gens dont le nom est Palmer </caption>
      <thead>
        <tr>
           <th>Firstname</th>
           <th>Lastname</th>
        </tr>
      </thead>
      <tbody>
    ";



    foreach ($conn -> query($sql) as $row) {
      echo "<tr><td>" . $row['first_name'] . "</td>";
      echo "<td class='text-danger'>" . $row['last_name'] . "</td></tr>";
      }
      echo  "</tbody></table></div>";



    $sql = "SELECT first_name, last_name, gender FROM `table 1` WHERE gender = 'female'";

    echo "<div class='container'>
      <table class='table table-hover table-striped'>
      <caption> gender </caption>
      <thead>
        <tr>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Gender</th>
        </tr>
      </thead>
      <tbody>
      ";




      foreach ($conn -> query($sql) as $row) {
        echo "<tr><td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['gender'] ."</td></tr>";
      }

      echo "</tbody></table></div>";




      $sql = "SELECT first_name, last_name, gender, country_code FROM `table 1` WHERE country_code LIKE 'n%'";


      echo "<div class='container'>
        <table class='table table-hover table-striped'>
        <caption> country_code </caption>
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Gender</th>
            <th>Country code</th>
          </tr>
        </thead>
        <tbody>
        ";

      foreach ($conn -> query($sql) as $row) {
        echo "<tr><td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['gender'] ."</td>";
        echo "<td>" . $row['country_code'] . "</td></tr>";
      }

      echo "</tbody></table></div>";



      $sql = "SELECT first_name, last_name, gender, country_code, email FROM `table 1` WHERE email LIKE '%google%'";

      echo "<div class='container'>
        <table class='table table-hover table-striped'>
        <caption> country code </caption>
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Gender</th>
            <th>Country code</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
        ";

      foreach ($conn -> query($sql) as $row) {
        echo "<tr><td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['gender'] ."</td>";
        echo "<td>" . $row['country_code'] ."</td>";
        echo "<td>" . $row['email'] . "</td></tr>";
      }

      echo "</tbody></table></div>";



      $sql = "SELECT first_name, last_name, gender, email, country_code, COUNT(*) as cnt FROM `table 1` GROUP BY country_code ORDER BY cnt ASC";

      echo "<div class='container'>
        <table class='table table-hover table-striped'>
        <caption> count </caption>
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Gender</th>
            <th>Country code</th>
            <th>Email</th>
            <th>Number</th>
          </tr>
        </thead>
        <tbody>
        ";

      foreach ($conn -> query($sql) as $row) {
        echo "<tr><td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['country_code'] . "</td>";
        echo "<td>" . $row['cnt'] . "</td></tr>";
      }

      echo "</tbody></table></div>";

// 6. Insérer un utilisateur
    $sql = "INSERT INTO `table 1` (id, first_name, last_name, email, gender) VALUES ('1001', 'Ali', 'Raza', 'ali.fhfcffcu@gmail.com', 'Male')";
     // Prepare la declaration
      $stmt = $conn->prepare($sql);
// // execute la requête
      $stmt->execute();


// lui mettre à jour son adresse mail

    $sql = "UPDATE `table 1` SET email = 'ali.fhfcffcu@gmail.com' WHERE id = 1001";
  // // Prepare la declaration
    $stmt = $conn->prepare($sql);
  // execute la requête
    $stmt->execute();

    // puis supprimer l’utilisateur
    $sql = "DELETE FROM `table 1` WHERE id = 1001";
    $stmt = $conn->prepare($sql);
    // execute la requête
      $stmt->execute();


    $sql = "SELECT COUNT(*) AS hommes FROM `table 1` WHERE gender='Male'";
    echo "<b> nombre d'hommes:</b><br>";
    foreach($conn -> query($sql) AS $row) {
      echo $row['hommes'] . "<br>";
    }
    $sql = "SELECT COUNT(*) AS femmes FROM `table 1` WHERE gender='Female'";
    echo "<b> nombre des femmes:</b><br>";
    foreach($conn -> query($sql) AS $row) {
      echo $row['femmes'] . "<br>";
    }


    $sql = "SELECT gender, AVG(DATEDIFF(CURRENT_DATE,STR_TO_DATE(birth_date,'%d/%m/%Y'))/365) AS age FROM `table 1` WHERE gender = 'Male'";
    foreach($conn->query($sql) AS $row) {
      echo "moyenne d'age des hommes:" . $row['age'];
    }
    $sql = "SELECT gender, AVG(DATEDIFF(CURRENT_DATE,STR_TO_DATE(birth_date,'%d/%m/%Y'))/365) AS age FROM `table 1` WHERE gender = 'Female'";
    foreach($conn->query($sql) AS $row) {
      echo "moyenne d'age des femmes:" . $row['age'];
    }






      $sql = "SELECT first_name, last_name, gender, country_code, email FROM `table 1` WHERE email = 'google'";

      echo "<div class='container'>
        <table class='table table-hover table-striped'>
        <caption> country code </caption>
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Gender</th>
            <th>Country code</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
        ";

      foreach ($conn -> query($sql) as $row) {
        echo "<tr><td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['gender'] ."</td>";
        echo "<td>" . $row['country_code'] ."</td>";
        echo "<td>" . $row['email'] . "</td></tr>";
      }

      echo "</tbody></table></div>";












     ?>

</body>
</html>
