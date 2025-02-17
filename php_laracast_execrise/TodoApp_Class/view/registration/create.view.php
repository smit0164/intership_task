<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - To-Do App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-4">Register</h2>
        <form action="/register" method="POST" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium">Full Name</label>
                <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                <?php if (!empty($errors['name'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?=$errors['name']?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                <?php if (!empty($errors['email'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?=$errors['email']?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                <?php if (!empty($errors['password'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?=$errors['password']?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Register</button>
        </form>
        <p class="text-sm text-center mt-4">Already have an account? <a href="login.html" class="text-blue-500 hover:underline">Login</a></p>
    </div>
</body>
</html>