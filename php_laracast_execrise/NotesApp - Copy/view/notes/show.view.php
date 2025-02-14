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
    <?php require base_path("view/Partials/navbar.php")?>
    <?php require base_path("view/Partials/header.php")?>

    <!-- Note Content -->
    <div class="max-w-2xl mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
        
        <!-- Back Button -->
        <a href="javascript:history.back()" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Go Back
        </a>

        <!-- Note Content -->
        <div class="mt-6">
            <p class="text-lg text-gray-700 border-l-4 border-blue-500 pl-4">
                <?= nl2br(htmlspecialchars($note['body'])) ?>
            </p>
        </div>

        <!-- Footer -->
        <footer class="mt-6">
            <a href="/note/edit?id=<?= $note['id'] ?>" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition duration-200">
                Edit Note
            </a>
        </footer>

    </div>

</body>
</html>
