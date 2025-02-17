<?php require_once 'Partials/header.php'?>

    <div class="bg-white shadow-lg rounded-xl p-6 w-96">
         <?php require_once 'Partials/Profile.php' ?>
      

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">To-Do List</h2>

       
        <form method="POST" action="/add" class="flex gap-2">
            <div class="flex flex-col flex-1">
                <input type="text" name="todo" 
                    class="border rounded-lg px-3 py-2 flex-1 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Add a new task...">
                <?php if (!empty($errors['todo'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['todo'] ?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add</button>
        </form>


       
        <ul class="mt-4 space-y-2">
            <?php foreach($todos as $todo) :?>
                <li class="flex justify-between items-center bg-gray-200 p-3 rounded-lg">
                    <span class="flex-1"><?= htmlspecialchars($todo['task'])?></span>
                    <div class="flex gap-2">

                        <a href="/todo/edit?id=<?=$todo['id']?>"><button class="text-blue-500 hover:text-blue-700 px-2 py-1 rounded-lg">✏️</button></a>
                        <form  method="POST" action="/delete">
                         <input type="hidden" name="_method" value="DELETE" >
                         <input type="hidden" name="id" value=<?= $todo['id']?> >
                         <button type="submit" class="text-red-500 hover:text-red-700 px-2 py-1 rounded-lg">✖</button>
                       </form>
                    </div>
                </li>
            <?php endforeach;?>
        </ul>
    </div>

<?php require_once "Partials/footer.php" ?>
