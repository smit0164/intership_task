<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Note</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar and Header -->
    <?php require "view/Partials/navbar.php"?>
    <?php require "view/Partials/header.php"?>

    <!-- Note Content -->
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <a href="javascript:history.back()" class="text-blue-500 hover:underline flex items-center">
            &larr; Go Back
        </a>

        <div class="mt-4">
            <p class="text-lg text-gray-700 border-l-4 border-blue-500 pl-4">
                <?= htmlspecialchars($note['body']) ?>
            </p>
        </div>
    </div>

</body>
</html>
