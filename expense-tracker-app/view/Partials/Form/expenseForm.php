<button onclick="openExpenseModal()" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
    ➕ Add Expense
</button>

<!-- Expense Modal -->
<div id="expenseModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Add Expense</h2>
        <form method="POST" id="expenseForm">

            <label class="block text-gray-700">Expense Name</label>
            <input type="text" name="expenseName" id="expenseName" class="w-full border p-2 rounded mt-1">
            <div class="error-text" id="errorExpenseName"></div>

            <label class="block text-gray-700 mt-3">Expense Amount</label>
            <input type="number" name="expenseAmount" id="expenseAmount" class="w-full border p-2 rounded mt-1" step="1" min="0">
            <div class="error-text" id="errorExpenseAmount"></div>

            <label class="block text-gray-700 mt-3">Expense Group</label>
            <select name="expenseGroup" id="expenseGroup" class="w-full border p-2 rounded mt-1">
                <option value="">Loading...</option>
            </select>
            <div class="error-text" id="errorExpenseGroup"></div>

            <label class="block text-gray-700 mt-3">Expense Date</label>
            <input type="date" name="expenseDate" id="expenseDate" class="w-full border p-2 rounded mt-1">
            <div class="error-text" id="errorExpenseDate"></div>

            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeExpenseModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" id="submitExpense" class="px-4 py-2 bg-green-500 text-white rounded">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openExpenseModal() {
        $("#expenseModal").removeClass("hidden");
        loadExpenseGroups();
        const now = new Date();
        const yyyy = now.getFullYear();
        const mm = String(now.getMonth() + 1).padStart(2, '0');
        const dd = String(now.getDate()).padStart(2, '0');
        const today = yyyy + '-' + mm + '-' + dd;
        $("#expenseDate").val(today);
    }

    function loadExpenseGroups() {
        $.ajax({
            url: "fetchGroups",
            type: "GET",
            dataType: "json",
            success: function(response) {
                let dropdown = $("#expenseGroup");
                dropdown.html('<option value="">Select Group</option>');

                if (response.success) {
                    response.groups.forEach(group => {
                        dropdown.append(`<option value="${group.id}">${group.groupName}</option>`);
                    });
                } else {
                    dropdown.html('<option value="">No groups found</option>');
                }
            },
            error: function() {
                $("#expenseGroup").html('<option value="">Error loading groups</option>');
            }
        });
    }

    function closeExpenseModal() {
        let form = $("#expenseForm");

        $("#expenseModal").addClass("hidden"); // Hide modal

        // Reset form fields & validation messages
        form.trigger("reset");
        form.validate().resetForm();

        // Remove error styles and clear error messages
        form.find("input, select, textarea").removeClass("error-input error-text");
        $(".error-text").text("");
    }

    $(document).ready(function() {
        $("#expenseForm").validate({
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
            errorPlacement: function(error, element) {
                let errorId = "#error" + element.attr("name").charAt(0).toUpperCase() + element.attr("name").slice(1);
                $(errorId).text(error.text());
                element.addClass("error-input");
            },
            success: function(label, element) {
                let errorId = "#error" + element.name.charAt(0).toUpperCase() + element.name.slice(1)
                $(errorId).text('');
                $(element).removeClass("error-input error-text");
            },
            submitHandler: function(form, event) {
                event.preventDefault();

                let formData = $("#expenseForm").serialize();
                $.ajax({
                    url: "/expenses",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            showToast("Expense added successfully!");
                            closeExpenseModal();
                            fetchGroupsAndExpenses();
                            updateDashboard();
                        } else {
                            showErrorToast(response.error);
                        }
                    },
                    error: function(xhr) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.errors) {
                            $("#errorExpenseName").text(response.errors.expenseName || "");
                            $("#errorExpenseAmount").text(response.errors.expenseAmount || "");
                            $("#errorExpenseGroup").text(response.errors.expenseGroup || "");
                            $("#errorExpenseDate").text(response.errors.expenseDate || "");
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