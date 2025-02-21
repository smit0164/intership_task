<?php if (!empty($group['expenses'])): ?>
    <?php $totalExpense=0 ;?>
    <ul class="space-y-2">
        <?php foreach ($group['expenses'] as $expense): ?>
            <?php $totalExpense += (float) ($expense['expenseAmount'] ?? 0); ?>
            <li class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                <span class="font-medium"><?= htmlspecialchars($expense['expenseName'] ?? 'Unknown Expense') ?></span>
                <span class="text-gray-600">₹<?= number_format((float) ($expense['expenseAmount'] ?? 0), 2) ?></span>
                <span class="text-sm text-gray-500">
                    <?= !empty($expense['expenseDate']) ? date("d M Y", strtotime($expense['expenseDate'])) : 'No Date' ?>
                </span>
                  
                <div class="space-x-2 flex">
                    <?php require basePath("view/Partials/Form/expenseEditModel.php") ?>
                    <?php require basePath("view/Partials/Form/expenseDelete.php")?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="mt-6 p-4 bg-gray-100 border border-gray-300 shadow-md rounded-lg flex justify-between items-center">
        <span class="text-lg font-semibold text-gray-700">Total Expense:</span>
        <span class="text-2xl font-bold text-green-600">₹<?= number_format($totalExpense, 2) ?></span>
    </div>
<?php else: ?>
    <p class="text-gray-500 text-center py-3">No expenses recorded in this group.</p>
<?php endif; ?>