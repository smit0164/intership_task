<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-[#1e1e2f] text-white">

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-5 right-5 space-y-4 z-50"></div>

    <div class="bg-white bg-opacity-10 backdrop-blur-md p-8 rounded-2xl shadow-lg border border-white border-opacity-20 w-96 text-center">
        <h2 class="text-2xl font-bold mb-6">Register</h2>
        
        <form method="POST" action="actions/register.php" class="space-y-4">
            <input type="text" name="username" placeholder="Username"  
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            
            <input type="email" name="email" placeholder="Email"  
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            
            <input type="password" name="password" placeholder="Password"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            
            <button type="submit" 
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition">
                Register
            </button>
        </form>
    </div>

    <script>
        function showToast(message, type) {
            const toastContainer = document.getElementById("toast-container");

            const toast = document.createElement("div");
            toast.className = `p-4 rounded-lg text-white shadow-lg transition-opacity duration-300 opacity-100 ${
                type === "success" ? "bg-green-500" : "bg-red-500"
            }`;

            toast.innerText = message;
            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = "0";
                setTimeout(() => toast.remove(), 300);
            }, 3000); // Auto-hide after 3 seconds
        }

        <?php
        if (isset($_SESSION['error'])) {
            echo "showToast('" . $_SESSION['error'] . "', 'error');";
            unset($_SESSION['error']); 
        }

        if (isset($_SESSION['success'])) {
            echo "showToast('" . $_SESSION['success'] . "', 'success');";
            unset($_SESSION['success']); 
        }
        ?>
    </script>
</body>
</html>
