<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-white shadow-lg p-4 rounded-lg text-center">
        <h3 class="text-gray-500 text-sm">Total Expenses</h3>
        <p class="text-2xl font-semibold text-gray-800">₹<?= $totalSum['total_expense']?? '0'?></p>

    </div>
    <div class="bg-white shadow-lg p-4 rounded-lg text-center">
        <h3 class="text-gray-500 text-sm">Highest Expense</h3>
        <p class="text-2xl font-semibold text-gray-800">₹<?= $maxExpense['max_expense'] ?? '0' ?></p>
    </div>
    <div class="bg-white shadow-lg p-4 rounded-lg text-center">
        <h3 class="text-gray-500 text-sm">This Month</h3>
        <p class="text-2xl font-semibold text-gray-800">₹<?= $thisMonth['total_this_month'] ?? '0' ?></p>
    </div>
</div>