<button onclick="openExpenseModal()" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
    ➕ Add Expense
</button>

<div id="expenseModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Add Expense</h2>
        <form method="POST" action="/expenses">
            <label class="block text-gray-700">Expense Name</label>
            <input type="text" name="expenseName" class="w-full border p-2 rounded mt-1" value="<?= $_SESSION['expenseName'] ?? '' ?>">

            <?php if (isset($_SESSION['errors']['expenseError']['expenseName'])): ?>
                <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 mt-5"><?= htmlspecialchars($_SESSION['errors']['expenseError']['expenseName']) ?></div>
            <?php endif; ?>

            <label class="block text-gray-700 mt-3">Expense Amount</label>
            <input type="number" name="expenseAmount" class="w-full border p-2 rounded mt-1" step="1" min="0" value="<?= $_SESSION['expenseAmount'] ?? '' ?>">

            <?php if (isset($_SESSION['errors']['expenseError']['expenseAmount'])): ?>
                <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 mt-5"><?= htmlspecialchars($_SESSION['errors']['expenseError']['expenseAmount']) ?></div>
            <?php endif; ?>

            <label class="block text-gray-700 mt-3">Expense Group</label>
            <select name="expenseGroup" class="w-full border p-2 rounded mt-1">
                <option value="">Select Group</option>
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group['groupName']?>"><?= $group['groupName'] ?></option>
                <?php endforeach; ?>
            </select>

            <?php if (isset($_SESSION['errors']['expenseError']['expenseGroup'])): ?>
                <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 mt-5"><?= htmlspecialchars($_SESSION['errors']['expenseError']['expenseGroup']) ?></div>
            <?php endif; ?>

            <label class="block text-gray-700 mt-3">Expense Date</label>
            <input type="date" name="expenseDate" class="w-full border p-2 rounded mt-1">

            <?php if (isset($_SESSION['errors']['expenseError']['expenseDate'])): ?>
                <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 mt-5"><?= htmlspecialchars($_SESSION['errors']['expenseError']['expenseDate']) ?></div>
            <?php endif; ?>

            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeExpenseModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Submit</button>
            </div>
        </form>
    </div>
</div>
<script>
    function openExpenseModal() {
        document.getElementById('expenseModal').classList.remove('hidden');
    }

    function closeExpenseModal() {
        document.getElementById('expenseModal').classList.add('hidden');

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
        <?php if (isset($_SESSION['errors']['expenseError'])): ?>
            document.getElementById('expenseModal').classList.remove('hidden');
        <?php endif; ?>
    });
</script>