<button onClick="openEditExpenseModal('<?= htmlspecialchars($expense['expenseName']) ?>', '<?= $expense['expenseAmount'] ?>', '<?= date('Y-m-d', strtotime($expense['expenseDate'])) ?>','<?= $expense['id'] ?>')"
    class="text-blue-500 hover:text-blue-700">
    ✏️ Edit
</button>

<div id="editExpenseModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Edit Expense</h2>
        <form id="editExpenseForm" method="POST" action="/editExpense">
            <?php if (isset($_SESSION['errors']['expenseEditError']['Databse'])): ?>
                <div id="editExpenseErrorMessage" class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 mt-5">
                    <?= htmlspecialchars($_SESSION['errors']['expenseEditError']['Databse']) ?>
                    <button type="button" onClick="toggleErrorMessage()" class="ml-2 text-sm text-gray-700 hover:text-gray-900">✖</button>
                </div>
            <?php endif; ?>
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" id="editExpenseId" value="<?= $_SESSION['expenseId'] ?? '' ?>">

            <label class="block mb-2">Expense Name:</label>
            <input type="text" name="expenseName" id="editExpenseName" class="w-full border p-2 rounded" value="<?= $_SESSION['expenseName'] ?? '' ?>">

            <?php if (isset($_SESSION['errors']['expenseEditError']['expenseName'])): ?>
                <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 mt-5"><?= htmlspecialchars($_SESSION['errors']['expenseEditError']['expenseName']) ?></div>
            <?php endif; ?>


            <label class="block mb-2 mt-2">Amount:</label>
            <input type="number" name="expenseAmount" id="editExpenseAmount" class="w-full border p-2 rounded" value="<?= $_SESSION['expenseAmount'] ?? '' ?>">

            <?php if (isset($_SESSION['errors']['expenseEditError']['expenseAmount'])): ?>
                <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 mt-5"><?= htmlspecialchars($_SESSION['errors']['expenseEditError']['expenseAmount']) ?></div>
            <?php endif; ?>

            <label class="block mb-2 mt-2">Date:</label>
            <input type="date" name="expenseDate" id="editExpenseDate" class="w-full border p-2 rounded" value="<?= $_SESSION['expenseDate'] ?? '' ?>" >
            <?php if (isset($_SESSION['errors']['expenseEditError']['expenseDate'])): ?>
                <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 mt-5"><?= htmlspecialchars($_SESSION['errors']['expenseEditError']['expenseDate']) ?></div>
            <?php endif; ?>

            <div class="flex justify-end mt-4">
                <button type="button" onClick="closeEditExpenseModal()" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditExpenseModal(expenseName, expenseAmount, expenseDate,expenseEditId) {
        document.getElementById('editExpenseName').value = expenseName;
        document.getElementById('editExpenseAmount').value = expenseAmount;
        document.getElementById('editExpenseDate').value = expenseDate;
        document.getElementById('editExpenseId').value = expenseEditId;
        document.getElementById('editExpenseModal').classList.remove('hidden');
    }

    function closeEditExpenseModal() {
        document.getElementById('editExpenseModal').classList.add('hidden');
        fetch('/clear-errors.php', {
                cache: "no-store"
            })
            .then(response => response.text())
            .then(data => {
                console.log("Server Response:", data);
                location.reload();
            })
            .catch(error => console.error("Fetch Error:", error));
    }
    document.addEventListener("DOMContentLoaded", () => {
        <?php if (isset($_SESSION['errors']['expenseEditError'])): ?>
            document.getElementById('editExpenseModal').classList.remove('hidden');
        <?php endif; ?>
    });
    function toggleErrorMessage() {
        const errorMessage = document.getElementById('editExpenseErrorMessage');
        if (errorMessage) {
            errorMessage.style.display = 'none'; 
        }
    }
</script>