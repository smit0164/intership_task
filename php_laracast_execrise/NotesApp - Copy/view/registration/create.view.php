<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body >
    
    <!-- Navbar -->
    <?php require base_path("view/Partials/navbar.php") ?>

   <!-- Wrapper Div to Center the Form -->
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Register</h2>

        <form action="/register" method="POST" class="mt-6">
            <!-- Name Field -->
        
            
            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                <input type="email" id="email" name="email" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <?php if(isset($errors['email'])): ?>
                <p class="text-red-500 text-xs mt-2 "><?= $errors['email'] ?></p>
             <?php endif;?>

            
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <?php if(isset($errors['password'])): ?>
                <p class="text-red-500 text-xs mt-2 "><?= $errors['password'] ?></p>
             <?php endif;?>
            <!-- Submit Button -->
            <button type="submit" 
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Register
            </button>
        </form>
    </div>
</div>


</body>
</html>
