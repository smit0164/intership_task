<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Link in PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-100 to-blue-300 min-h-screen flex flex-col">

    <!-- Navbar and Header -->
    <?php require base_path("view/Partials/navbar.php")?>
    <?php require base_path("view/Partials/header.php")?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col justify-center items-center px-4">
      

    <form method="post" class="max-w-lg w-full bg-white p-6 rounded-lg shadow-lg"  action="/notes">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?=$note['id']?>">
        <textarea 
                name="body" 
                placeholder="Enter your note here..." 
                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none min-h-[150px]"
            ><?=$note['body']?>
            </textarea>
            <?php if(isset($errors['body'])): ?>
                <p class="text-red-500 text-xs mt-2 "><?= $errors['body'] ?></p>
             <?php endif;?>
            <p class="mt-4">
                <a
                   href="/notes" 
                    
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition"
                >
                  Cancel
              </a>
            </p>
            <p class="mt-4">
                <button type="submit"
                    
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition"
                >
                    Update
            </button>
            </p>
    </form>
    </div>

</body>
</html>
