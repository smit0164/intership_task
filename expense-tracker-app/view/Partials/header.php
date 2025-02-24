<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        function fetchGroupsAndExpenses() {
            $.ajax({
                url: "/fetchData",
                type: "GET",
                data: { type: "groups" },
                dataType: "json",
                success: function(response) {
                    $("#groupList").empty(); // Clear existing groups

                    if (response.success && response.groups.length > 0) {
                        $("#noGroupMessage").addClass("hidden"); // Hide 'No groups' message
                        response.groups.forEach(group => {
                            let groupHTML = `
                                <div id="group-${group.id}" class="p-6 bg-white shadow-lg rounded-lg mb-6 hover:shadow-xl transition duration-300 ease-in-out">
                                    <div class="flex justify-between items-center">
                                        <p class="text-xl font-semibold text-blue-700">${group.groupName}</p>
                                        <button onclick="openDeleteModal(${group.id})" class="bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition-colors duration-200">
                                            🗑 Delete
                                        </button>
                                    </div>
                                    <div class="mt-4">
                                        <ul id="expense-list-${group.id}" class="ml-4 text-gray-700">
                                            <li class="text-gray-500">Loading expenses...</li>
                                        </ul>
                                    </div>
                                    <div class="mt-4 text-right">
                                        <span id="total-expense-${group.id}" class="text-lg font-bold text-green-600">Total Expense: ₹0.00</span>
                                    </div>
                                </div>
                            `;
                            $("#groupList").append(groupHTML);
                            fetchExpenses(group.id); // Fetch expenses for this group
                        });
                    } else {
                        $("#noGroupMessage").removeClass("hidden"); // Show 'No groups' message
                    }
                },
                error: function() {
                    console.error("❌ Failed to fetch groups.");
                    $("#groupList").html("<p class='text-red-500 text-center'>Failed to load data. Please try again later.</p>");
                }
            });
        }

        function fetchExpenses(groupId) {
            $.ajax({
                url: "/fetchData?type=expenses&groupId=" + groupId,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    let expenseList = $("#expense-list-" + groupId);
                    expenseList.empty(); 
                    let totalExpense = 0;

                    if (response.success && response.expenses.length > 0) {
                        response.expenses.forEach(expense => {
                            let expenseHTML = `
                                <li id="expense-${expense.id}" class="flex justify-between items-center p-4 bg-gray-50 rounded-lg shadow-sm hover:bg-gray-100 transition duration-200 ease-in-out mb-2">
                                    <div class="flex-1">
                                        <p class="text-lg font-semibold text-blue-600">${expense.expenseName}</p>
                                        <p class="text-sm text-gray-500">${expense.expenseDate}</p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="text-lg text-green-600">₹${expense.expenseAmount}</span>
                                        <button onclick="openDeleteExpenseModal(${expense.id}, ${groupId})" class="bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition-colors duration-200">
                                            🗑 Delete
                                        </button>
                                    </div>
                                </li>
                            `;
                            expenseList.append(expenseHTML);
                            totalExpense += parseFloat(expense.expenseAmount);
                        });
                        // Show total expense
                        $("#total-expense-" + groupId).text(`Total Expense: ₹${totalExpense.toFixed(2)}`);
                    } else {
                        expenseList.append("<li class='text-gray-500'>No expenses found.</li>");
                        $("#total-expense-" + groupId).text('Total Expense: ₹0.00');
                    }
                },
                error: function() {
                    console.error("❌ Failed to fetch expenses for group " + groupId);
                }
            });
        }


        $(document).ready(function() {
            fetchGroupsAndExpenses(); // Load groups and expenses when page loads
        });
    </script>
  
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-center mb-6">Expense Tracker</h1>