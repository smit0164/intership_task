<?php
session_start();
require "../config/db.php";



$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
$success="";
$error="";
if(isset($_SESSION['success'])){
     $success=$_SESSION['success'];
     unset($_SESSION['success']);
}
if(isset($_SESSION['error'])){
    $error= $_SESSION['error'];
    unset($_SESSION['error']);
}
//user detail for profile
$sql="SELECT username,email FROM users WHERE id=?";
$st=$conn->prepare($sql);
$st->execute([$user_id]);
$user_info=$st->fetch(PDO::FETCH_ASSOC);

$sql="SELECT COUNT(*) AS TOTAL from tasks where user_id=?";
$st=$conn->prepare($sql);
$st->execute([$user_id]);
$total_task=$st->fetch(PDO::FETCH_ASSOC)['TOTAL'];

$sql="SELECT COUNT(*) AS COMP from tasks where user_id=? AND status=?";
$st1=$conn->prepare($sql);
$st1->execute([$user_id,"completed"]);
$completed=$st1->fetch(PDO::FETCH_ASSOC)['COMP'];


$pending=$total_task-$completed;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        
        <!-- Profile Section -->
        <div class="flex items-center justify-between mb-4 p-4 bg-gray-200 rounded-lg">
    <div class="flex items-center space-x-4">
        <div class="w-12 h-12 bg-blue-500 text-white flex items-center justify-center text-lg font-bold rounded-full">
            <?php echo strtoupper(substr($user_info['username'], 0, 1)); ?>
        </div>
        <div>
            <h3 class="text-lg font-semibold"> <?php echo htmlspecialchars($user_info['username']) ?> </h3>
            <p class="text-sm text-gray-600"> <?php echo htmlspecialchars($user_info['email']) ?> </p>
        </div>
    </div>
    
    <!-- Logout Button -->
    <form action="../actions/logout.php" method="post">
        <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600 transition">
            Logout
        </button>
    </form>
</div>
        
        <!-- Task Summary -->
        <div class="mb-4 p-4 bg-gray-100 rounded-lg">
            <h4 class="text-md font-bold text-gray-700">Task Summary</h4>
            <div class="mt-2 grid grid-cols-3 gap-4 text-center">
                <div class="p-2 bg-blue-100 text-blue-700 font-bold rounded-lg">Total: <span><?= $total_task ?></span></div>
                <div class="p-2 bg-green-100 text-green-700 font-bold rounded-lg">Completed: <span><?= $completed ?></span></div>
                <div class="p-2 bg-red-100 text-red-700 font-bold rounded-lg">Pending: <span><?= $pending ?></span></div>
            </div>
        </div>
        
        <!-- Task Input -->
        <form method="POST" action="../actions/add_todo.php" class="flex gap-2 mb-4">
            <input type="text" name="todo" class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Enter a task..." required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Add</button>
        </form>
        
        <!-- Success and Error Messages -->
        <?php if(!empty($success)): ?>
        <div id="erro-message" class="bg-green-100 text-green-700 border border-green-500 p-3 rounded-md shadow-md mb-3">
            <?php echo $success ?>
        </div>
        <?php endif; ?>

        <?php if(!empty($error)): ?>
        <div id="error-message"class="bg-red-100 text-red-700 border border-red-500 p-3 rounded-md shadow-md mb-3">
            <?php echo $error ?>
        </div>
      
        <?php endif; ?>

        <!-- Task List -->
        <ul class="space-y-2">
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <li class="flex justify-between items-center bg-gray-200 p-3 rounded-md shadow-md">
                        <span class="<?php echo ($task['status']=='completed') ? 'line-through text-gray-500' : ''; ?>">
                            <?php echo htmlspecialchars($task['task_description']); ?>
                        </span>

                        <div class="flex space-x-2">
                            <?php if($task['status'] !== 'completed'): ?>
                                <form method="post" action="../actions/update_todo.php">
                                    <input type="hidden" name="complete" value="<?php echo $task['id']?>">
                                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 transition">✅</button>
                                </form>
                            <?php endif; ?>
                            <form method="post" action="../actions/delete_todo.php">
                                <input type="hidden" name="delete" value="<?php echo $task['id']?>">
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">✖</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="text-gray-500 text-center p-3">No tasks found.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
