<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Authentication System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-[#1e1e2f] text-white">
    <main class="flex items-center justify-center">
        <section class="bg-white bg-opacity-10 backdrop-blur-md p-8 rounded-2xl shadow-lg border border-white border-opacity-20 max-w-md w-full text-center">
            <h1 class="text-3xl font-bold mb-6">Welcome to the Authentication System</h1>
            <p class="text-gray-300 mb-8">If you are new here, click on Register.</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 justify-center">
                <a href="register.php" class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-lg text-lg transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" aria-label="Register">
                    Register
                </a>
                <a href="login.php" class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-lg text-lg transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" aria-label="Login">
                    Login
                </a>
                <a href="pages/dashboard.php" class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-lg text-lg transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" aria-label="Dashboard">
                    Dashboard
                </a>
            </div>
        </section>
    </main>
</body>
</html>