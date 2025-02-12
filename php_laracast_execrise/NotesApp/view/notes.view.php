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
<?php foreach ($notes as $note):?>
    <li>
        
        <a href="note?id=<?php echo $note['id']; ?>" class="text-blue-500 hover:underline">
            <?=$note['body']?>
        </a>
    </li>
<?php endforeach;?>
</body>
</html>