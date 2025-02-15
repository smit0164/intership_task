<nav class="bg-blue-900 p-4 shadow-md">
    <div class="max-w-6xl mx-auto flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="text-white text-lg font-semibold">MyWebsite</a>

        <!-- Desktop Menu -->
        <div class="hidden sm:flex space-x-4">
            <?php
            $routes = [
                '/' => 'Home',
                '/about' => 'About',
                '/notes' => 'Notes',
                '/contact' => 'Contact Us'
            ];
            foreach ($routes as $path => $name):
            ?>
                <a href="<?= $path ?>" 
                   class="<?= $_SERVER['REQUEST_URI'] == $path ? 'bg-blue-700 text-white' : 'text-gray-300' ?> 
                          rounded-lg px-4 py-2 text-sm font-medium hover:bg-blue-700 hover:text-white transition">
                    <?= $name ?>
                </a>
            <?php endforeach; ?>
        </div>
       
        
        <!-- User Authentication Links -->
        <div class="hidden sm:flex items-center space-x-4">
            <?php if(isset($_SESSION['user'])): ?>
                <span class="text-gray-300"><?= htmlspecialchars($_SESSION['user']) ?></span>
                <form method="post" action="/session">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="text-white bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition">
                    Log Out
                   </button>

                </form>
            <?php else: ?>
                <a href="/login" class="text-gray-300 hover:text-white text-sm">Login</a>
                <a href="/register" class="text-gray-300 hover:text-white text-sm">Register</a>
            <?php endif; ?>
        </div>

        <!-- Mobile Menu Button -->
        <button id="menu-toggle" class="sm:hidden text-white focus:outline-none">
            ☰
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden sm:hidden flex flex-col mt-2 space-y-2 bg-blue-800 p-4 rounded-lg">
        <?php foreach ($routes as $path => $name): ?>
            <a href="<?= $path ?>" 
               class="<?= $_SERVER['REQUEST_URI'] == $path ? 'bg-blue-700 text-white' : 'text-gray-300' ?> 
                      rounded-lg px-4 py-2 text-sm font-medium hover:bg-blue-700 hover:text-white transition">
                <?= $name ?>
            </a>
        <?php endforeach; ?>

        <!-- Mobile Authentication Links -->
       
        <?php if(isset($_SESSION['user'])): ?>
            <span class="text-gray-300"><?= htmlspecialchars($_SESSION['user']) ?></span>
            <a href="/logout" class="text-red-400 hover:text-red-300 text-sm">Logout</a>
        <?php else: ?>
            <a href="/login" class="text-gray-300 hover:text-white text-sm">Login</a>
            <a href="/register" class="text-gray-300 hover:text-white text-sm">Register</a>
        <?php endif; ?>
    </div>
</nav>

<script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
        document.getElementById("mobile-menu").classList.toggle("hidden");
    });
</script>
