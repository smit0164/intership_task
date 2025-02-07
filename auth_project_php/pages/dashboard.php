<?php
session_start();
require '../config/db.php';

$successMessage = "";

if (isset($_SESSION['success'])) {
    $successMessage = $_SESSION['success'];
    unset($_SESSION['success']); // Clear after displaying
}

if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['remember_token'])) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE remember_token = ?");
        $stmt->execute([$_COOKIE['remember_token']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
        } else {
            header("Location: ../login.php");
            exit();
        }
    } else {
        header("Location: ../login.php");
        exit();
    }
}

// Function to determine greeting based on time
function getGreeting() {
    $hour = date('H');
    if ($hour < 12) {
        return "Good Morning";
    } elseif ($hour < 18) {
        return "Good Afternoon";
    } else {
        return "Good Evening";
    }
}

$greeting = getGreeting();
$loginTime = date('h:i A'); // Display current time as login time
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="flex items-center justify-center h-screen bg-[#1e1e2f] text-white">
    <div class="bg-white bg-opacity-10 backdrop-blur-md p-8 rounded-2xl shadow-lg border border-white border-opacity-20 w-96 text-center">
        
        <h2 class="text-2xl font-bold mb-3"><?php echo $greeting; ?>, <?php echo $_SESSION['username']; ?>! 👋</h2>
        <p class="text-gray-300 text-sm mb-4">You logged in at <strong><?php echo $loginTime; ?></strong></p>

        <div class="bg-gray-800 p-4 rounded-lg mb-4">
            <p class="text-gray-400 text-sm">"Success is not final, failure is not fatal: It is the courage to continue that counts." 💡</p>
        </div>

        <a href="../actions/logout.php" 
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition">
            Logout
        </a>
    </div>

    <?php if (!empty($successMessage)) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?php echo $successMessage; ?>',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    <?php endif; ?>
</body>
</html>
