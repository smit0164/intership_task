<?php require basePath("view/Partials/header.php") ?>
<?php require basePath("view/Partials/button.php") ?>
<?php require basePath("view/Partials/Dashboard.php") ?>
<?php if (!empty($groupedData)): ?>
    <?php foreach ($groupedData as $groupName => $group): ?>
        <div class="bg-white shadow-lg rounded-lg p-4 mb-6">
            <?php require basePath("view/Partials/groupLoad.php")?>  
            <?php require basePath("view/Partials/expenseLoad.php")?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-gray-500 text-center py-5">No expense groups found. Start by adding a group!</p>
<?php endif; ?>

</body>
</html>
