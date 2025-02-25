<!-- Edit Expense Modal -->
<div id="editExpenseModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Edit Expense</h2>
        <form id="editExpenseForm" method="POST">
            <input type="hidden" name="id" id="editExpenseId">
            <input type="hidden" name="_method" value="PATCH">


            <label class="block text-gray-700">Expense Name</label>
            <input type="text" name="expenseName" id="editExpenseName" class="w-full border p-2 rounded mt-1">
            <div class="error-text" id="errorEditExpenseName"></div>

            <label class="block text-gray-700 mt-3">Expense Amount</label>
            <input type="number" name="expenseAmount" id="editExpenseAmount" class="w-full border p-2 rounded mt-1" step="1" min="0">
            <div class="error-text" id="errorEditExpenseAmount"></div>

            <label class="block text-gray-700 mt-3">Expense Group</label>
            <select name="expenseGroup" id="editExpenseGroup" class="w-full border p-2 rounded mt-1">
                <option value="">Loading...</option> <!-- Placeholder until AJAX loads data -->
            </select>
            <div class="error-text" id="errorEditExpenseGroup"></div>

            <label class="block text-gray-700 mt-3">Expense Date</label>
            <input type="date" name="expenseDate" id="editExpenseDate" class="w-full border p-2 rounded mt-1">
            <div class="error-text" id="errorEditExpenseDate"></div>

            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeEditExpenseModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" id="submitEditExpense" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openExpenseEditModal(expenseId, expenseName, expenseAmount, expenseDate, expenseGroupId) {
        $("#editExpenseId").val(expenseId);
        $("#editExpenseName").val(expenseName);
        $("#editExpenseAmount").val(expenseAmount);
        $("#editExpenseDate").val(expenseDate);
        loadExpenseGroupsForEdit(expenseGroupId); // Load groups and select the correct one

        $("#editExpenseModal").removeClass("hidden");
    }

    function loadExpenseGroupsForEdit(selectedGroupId) {
        $.ajax({
            url: "fetchGroups",
            type: "GET",
            dataType: "json",
            success: function(response) {
                let dropdown = $("#editExpenseGroup");
                dropdown.html('<option value="">Select Group</option>');

                if (response.success) {
                    response.groups.forEach(group => {
                        let isSelected = (group.id == selectedGroupId) ? "selected" : "";
                        dropdown.append(`<option value="${group.id}" ${isSelected}>${group.groupName}</option>`);
                    });
                } else {
                    dropdown.html('<option value="">No groups found</option>');
                }
            },
            error: function() {
                $("#editExpenseGroup").html('<option value="">Error loading groups</option>');
            }
        });
    }

    function closeEditExpenseModal() {
        let form = $("#editExpenseForm");

        $("#editExpenseModal").addClass("hidden"); 
        form.trigger("reset");
        form.validate().resetForm();

        form.find("input, select, textarea").removeClass("error-input error-text");
       $(".error-text").text("");
    }

    $(document).ready(function () {
        $("#editExpenseForm").validate({
            rules: {
                expenseName: {
                    required: true,
                    minlength: 3
                },
                expenseAmount: {
                    required: true,
                    number: true,
                    min: 1
                },
                expenseGroup: {
                    required: true
                },
                expenseDate: {
                    required: true,
                    date: true
                }
            },
            messages: {
                expenseName: {
                    required: "Expense name is required",
                    minlength: "Expense name must be at least 3 characters"
                },
                expenseAmount: {
                    required: "Amount is required",
                    number: "Amount must be a valid number",
                    min: "Amount must be at least 1"
                },
                expenseGroup: {
                    required: "Please select an expense group"
                },
                expenseDate: {
                    required: "Please select a date",
                    date: "Invalid date format"
                }
            },
            errorClass: "error-text",
            errorPlacement: function (error, element) {
                let errorId = "#errorEdit" + element.attr("name").charAt(0).toUpperCase() + element.attr("name").slice(1);
                $(errorId).text(error.text());
                element.addClass("error-input");
            },
            success: function (label, element) {
                let errorId = "#errorEdit" + element.name.charAt(0).toUpperCase() + element.name.slice(1);
                $(errorId).text('');
                $(element).removeClass("error-input error-text");
            },
            submitHandler: function (form, event) {
                event.preventDefault();
                
                let formData = $("#editExpenseForm").serialize();
               

                $.ajax({
                    url: "/editExpense",
                    type: "POST",
                    data: formData,
                    dataType:"json",
                    success: function (response) {
                        if (response.success) {
                            showToast("Expense updated successfully!");
                            closeEditExpenseModal();
                            fetchGroupsAndExpenses();
                            updateDashboard();
                        } else {
                            showErrorToast(response.error);
                        }
                    },
                    error: function (xhr) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.errors) {
                            $("#errorEditExpenseName").text(response.errors.expenseName || "");
                            $("#errorEditExpenseAmount").text(response.errors.expenseAmount || "");
                            $("#errorEditExpenseGroup").text(response.errors.expenseGroup || "");
                            $("#errorEditExpenseDate").text(response.errors.expenseDate || "");
                        } else {
                            let errorMsg = (xhr.responseJSON && xhr.responseJSON.error) ? xhr.responseJSON.error : "Server error";
                            showErrorToast(errorMsg);
                        }
                    },
                    
                });
            }
        });
    });
</script>
