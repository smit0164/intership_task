
<div class="flex items-center gap-3 mb-4">
            <img src="profile.jpg" alt="Profile" class="w-12 h-12 rounded-full border border-gray-300 object-cover">
            <div>
                <h3 class="text-lg font-semibold text-gray-700"><?= $_SESSION['name']??"Jon"?></h3>
                <p class="text-sm text-gray-500"><?= $_SESSION['email']??"Jon@gmail.com"?></p>
            </div>
</div>