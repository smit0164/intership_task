<div class="flex justify-between items-center border-b pb-2 mb-3">
    <h2 class="text-xl font-semibold text-gray-700"><?= htmlspecialchars($groupName) ?></h2>
    <div class="space-x-2 flex">
        <?php require basePath("view/Partials/Form/groupEditModel.php") ?>
        <?php require basePath("view/Partials/Form/groupDelete.php")?>
    </div>
</div>
