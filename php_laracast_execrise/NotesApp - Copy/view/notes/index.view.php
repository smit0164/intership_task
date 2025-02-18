<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Link in PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar and Header -->
    <?php require base_path("view/Partials/navbar.php")?>
    <?php require base_path("view/Partials/header.php")?>

    <!-- Notes List -->
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Your Notes</h1>
        <?php if(isset($_SESSION['user'])):?>
         <ol class="space-y-3">
            <?php foreach ($notes as $note): ?>
                <li class="border-b pb-2">
                    <a href="note?id=<?php echo $note['id']; ?>" class="text-blue-600 font-medium hover:underline">
                        <?= htmlspecialchars($note['body']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ol>
        <?php endif;?>
        <p class="mt-6 text-center">
            <a href="/notes/create" class="text-white bg-blue-500 py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Create Note
            </a>
        </p>
    </div>

</body>
</html>
