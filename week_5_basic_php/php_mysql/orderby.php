<?php


echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myper";

try {
  // Create a PDO connection
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // Prepare and execute SQL statement
  $stmt = $conn->prepare("SELECT id, firstname, lastname FROM MyGuests  ORDER BY lastname");
  $stmt->execute();

  // Iterate over the rows using a simple while loop
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['firstname'] . "</td>";
    echo "<td>" . $row['lastname'] . "</td>";
    echo "</tr>";
  }

} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
echo "</table>";




?>
