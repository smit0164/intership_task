<?php require basePath("view/Partials/header.php") ?>
<?php require basePath("view/Partials/button.php") ?>
<?php require basePath("view/Partials/Dashboard.php") ?>

<div id="groupList">
    <!-- Groups will be loaded dynamically via AJAX -->
</div>

<p id="noGroupMessage" class="text-gray-500 text-center py-5 hidden">No expense groups found. Start by adding a group!</p>


<?php require basePath("view/Partials/groupDeleteModal.php")?>

<?php require basePath("view/Partials/expenseDeleteModal.php")?>
</body>

</html>