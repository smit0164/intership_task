<?php
session_start();
if(isset($_SESSION['error'])){
    $error=$_SESSION['error'];
    unset($_SESSION['error']);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
   
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        <form action="../actions/register.php" method="post">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" name="username">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email" name="email">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Password" name="password">
            </div>
            <div class="mb-4">
                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit" value="Register">
            </div>
        </form>
       
    </div>
    <div id="toast-container" class="fixed top-5 right-5 space-y-3 z-50">
    </div>
    <?php if(!empty($error)):?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
        showToast("<?php echo addslashes($error); ?>", "error");
          });
        </script>
    <?php endif; ?>

    <script>
     function showToast(message,type){
        let toastContainer = document.getElementById('toast-container');
        
        let toast = document.createElement('div');
        toast.classList.add(
        "p-4", "rounded-md", "shadow-lg", "w-64",
        "flex", "items-center", "justify-between", "transition", "duration-500",
        "opacity-0", "transform", "translate-x-5",
        "bg-white", "border"
      );
      toast.classList.add("border-red-500", "text-red-700", "shadow-red-300");
        toast.innerHTML = `
            <span>${message}</span>
            <button onclick="this.parentElement.remove()" class="text-white font-bold px-2">✖</button>
        `;

        toastContainer.appendChild(toast);
        
        // Fade in effect
        setTimeout(() => {
            toast.classList.remove("opacity-0", "translate-x-5");
        }, 100);

        // Auto remove after 3 seconds
        setTimeout(() => {
            toast.classList.add("opacity-0", "translate-x-5");
            setTimeout(() => toast.remove(), 500);
        }, 3000);
     }
    </script>
</body>
</html>