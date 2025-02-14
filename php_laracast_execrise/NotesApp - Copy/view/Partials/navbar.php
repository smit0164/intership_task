<nav class="bg-blue-900 p-4 shadow-md">
    <div class="max-w-6xl mx-auto flex items-center justify-between">
        <div class="hidden sm:block">
            <div class="flex space-x-4">
                <a href="/" class="<?= url('/') ? 'bg-blue-700 text-white' : 'text-gray-300' ?> rounded-lg px-4 py-2 text-sm font-medium hover:bg-blue-700 hover:text-white transition">
                    Home
                </a>
                <a href="/about" class="<?= url('/about') ? 'bg-blue-700 text-white' : 'text-gray-300' ?> rounded-lg px-4 py-2 text-sm font-medium hover:bg-blue-700 hover:text-white transition">
                    About
                </a>
                <a href="/notes" class="<?= url('/notes') ? 'bg-blue-700 text-white' : 'text-gray-300' ?> rounded-lg px-4 py-2 text-sm font-medium hover:bg-blue-700 hover:text-white transition">
                    Notes
                </a>
                <a href="/contact" class="<?= url('/contact') ? 'bg-blue-700 text-white' : 'text-gray-300' ?> rounded-lg px-4 py-2 text-sm font-medium hover:bg-blue-700 hover:text-white transition">
                    Contact Us
                </a>
            </div>
            <?= $_SESSION['user']?>
            <?php if(isset($_SESSION['user'])):?>
                 <?= $_SESSION['user']['email']?>
            <?php else: ?>
                 <a href="/register">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
