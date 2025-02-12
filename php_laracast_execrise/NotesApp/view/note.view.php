<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Link in PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php require "Partials/navbar.php"?>
<?php require  "Partials/header.php"?>

        <a href="" class="text-blue-500 hover:underline">Go Back</a>
        <p>
            <?=$note['body']?>
        </p>
    

</body>
</html>

