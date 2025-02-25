<!-- Delete Confirmation Modal for Expense -->
<div id="deleteExpenseModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Confirm Deletion</h2>
        <p>Are you sure you want to delete this expense?</p>
        
        <form id="deleteExpenseForm" method="POST">
            <input type="hidden" name="_method" value="DELETE"> <!-- Required for your PHP routing -->
            <input type="hidden" name="expenseId" id="deleteExpenseId"> <!-- Store Expense ID -->
            <input type="hidden" name="groupId" id="deleteExpenseGroupId"> <!-- Store Group ID -->
        </form>
        
        <div class="mt-6 flex justify-end space-x-3">
            <button onclick="closeDeleteExpenseModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            <button onclick="confirmDeleteExpense()" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
        </div>
    </div>
</div>
<script>
    function openDeleteExpenseModal(expenseId, groupId) {
    $("#deleteExpenseId").val(expenseId); // Store Expense ID in hidden input
    $("#deleteExpenseGroupId").val(groupId); // Store Group ID in hidden input
    $("#deleteExpenseModal").removeClass("hidden"); // Show modal
}

function closeDeleteExpenseModal() {
    $("#deleteExpenseModal").addClass("hidden"); // Hide modal
}

function confirmDeleteExpense() {
    let expenseId = $("#deleteExpenseId").val(); // Get stored Expense ID
    let groupId = $("#deleteExpenseGroupId").val(); // Get stored Group ID
    
    $.ajax({
        url: "/deleteExpense",  // Ensure PHP route exists
        type: "POST",        //  Using POST to simulate DELETE
        data: $("#deleteExpenseForm").serialize(),
        dataType: "json",
        success: function(response) {
            if (response.success) {
                closeDeleteExpenseModal(); //  Close modal after deletion
                showToast("Expense deleted successfully!");
                fetchExpenses(groupId); // Refresh the expenses list for the group
                updateDashboard();
            } else {
                showErrorToast(response.error);
            }
        },
        error: function(xhr) {
            let errorMsg = (xhr.responseJSON && xhr.responseJSON.error) ? xhr.responseJSON.error : "Server error";
            showErrorToast(errorMsg);
        }
    });
}

</script>