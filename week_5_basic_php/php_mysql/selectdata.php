<?php
// echo "<table style='border: solid 1px black;'>";
// echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

// class TableRows extends RecursiveIteratorIterator {
  
//   // Constructor
//   function __construct($it) {
//     parent::__construct($it, self::LEAVES_ONLY);
//   }

//   // Suppress deprecation warning with #[\ReturnTypeWillChange] OR set return type to mixed
//   #[\ReturnTypeWillChange]  // Suppresses the warning for current method (or you can use mixed return type)
//   function current(): mixed {  
//     return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
//   }

//   #[\ReturnTypeWillChange]  // Suppresses the warning for beginChildren method (or use void return type)
//   function beginChildren(): void {
//     echo "<tr>";
//   }

//   #[\ReturnTypeWillChange]  // Suppresses the warning for endChildren method (or use void return type)
//   function endChildren(): void {
//     echo "</tr>" . "\n";
//   }
// }

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "myper";

// try {
//   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
//   // Prepare and execute SQL statement
//   $stmt = $conn->prepare("SELECT id, firstname, lastname FROM MyGuests");
//   $stmt->execute();

//   // Set the resulting array to associative
//   $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

//   // Iterate through the result directly using foreach (without RecursiveArrayIterator)
//   foreach ($stmt->fetchAll() as $row) {
//     echo "<tr><td>" . $row['id'] . "</td><td>" . $row['firstname'] . "</td><td>" . $row['lastname'] . "</td></tr>";
//   }
  
// } catch(PDOException $e) {
//   echo "Error: " . $e->getMessage();
// }

// $conn = null;
// echo "</table>";


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
  $stmt = $conn->prepare("SELECT id, firstname, lastname FROM MyGuests");
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
