<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit To-Do</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-4">Edit To-Do</h2>
    
         
        <form action="/todo/edit" method="POST" class="space-y-4">
            <input type="hidden" name="id" value="<?=htmlspecialchars($todo['id'])?>">
            <input type="hidden" name="_method" value="PUT">
            <div>
                <label class="block text-gray-700">Task Name:</label>
                <input type="text" name="task" value="<?=htmlspecialchars($todo['task'])?>"  class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                <?= $errors['todo']??""?>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                Update Task
            </button>
        </form>

        <a href="/" class="block text-center text-gray-600 mt-4">Cancel</a>
    </div>
</body>
</html>
