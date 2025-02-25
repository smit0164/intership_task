<?php require basePath("view/Partials/header.php") ?>
<?php require basePath("view/Partials/Button.php") ?>
<?php require basePath("view/Partials/Dashboard.php") ?>

<div id="groupList">
  
</div>

<p id="noGroupMessage" class="text-gray-500 text-center py-5 hidden">No expense groups found. Start by adding a group!</p>


<?php require basePath("view/Partials/Form/groupDeleteModal.php")?>
<?php require basePath("view/Partials/Form/expenseDeleteModal.php")?>

<?php require basePath("view/Partials/Form/groupEditModal.php");?>
<?php require basePath("view/Partials/Form/expenseEditModal.php")?>

<script>
function fetchGroupsAndExpenses() {
    $.ajax({
        url: "/fetchData",
        type: "GET",
        data: {
            type: "groups"
        },
        dataType: "json",
        success: function(response) {
            $("#groupList").empty(); 

            if (response.success && response.groups.length > 0) {
                $("#noGroupMessage").addClass("hidden"); 
                response.groups.forEach(group => {
                    let groupHTML = `
                        <div id="group-${group.id}" class="p-6 bg-gradient-to-r from-blue-50 to-white shadow-lg rounded-lg mb-6 hover:shadow-xl transition duration-300 ease-in-out">
                            <div class="flex justify-between items-center">
                                <p class="text-xl font-semibold text-blue-700">${group.groupName}</p>
                                <div class="flex space-x-2">
                                    <button onclick="openGroupEditModal(${group.id},'${group.groupName}')" class="bg-white text-blue-500 border border-blue-500 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition-colors duration-200 flex items-center">
                                         <span class="ml-1">Edit</span>
                                    </button>
                                    <button onclick="openDeleteModal(${group.id})" class="bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition-colors duration-200 flex items-center">
                                         <span class="ml-1">Delete</span>
                                    </button>
                                </div>
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
            console.error("Failed to fetch groups.");
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
                    let formattedDate = new Date(expense.expenseDate).toISOString().split("T")[0];
                    let expenseHTML = `
                        <li id="expense-${expense.id}" class="flex justify-between items-center p-4 bg-gray-50 rounded-lg shadow-sm hover:bg-gray-100 transition duration-200 ease-in-out mb-2">
                            <div class="flex-1">
                                <p class="text-lg font-semibold text-blue-600">${expense.expenseName}</p>
                                <p class="text-sm text-gray-500">${expense.expenseDate}</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-lg text-green-600">₹${expense.expenseAmount}</span>
                               <button onclick="openExpenseEditModal(${expense.id}, '${expense.expenseName}', ${expense.expenseAmount}, '${formattedDate}', ${expense.expenseGroup})" class="bg-white text-blue-500 border border-blue-500 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition-colors duration-200 flex items-center">
                                 <span class="ml-1">Edit</span>
                               </button>
                               
                                <button onclick="openDeleteExpenseModal(${expense.id}, ${groupId})" class="bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition-colors duration-200">
                                    <span class="ml-1">Delete</span>
                                </button>
                                 
                            </div>
                        </li>
                    `;
                    expenseList.append(expenseHTML);
                    totalExpense += parseFloat(expense.expenseAmount);
                });
                $("#total-expense-" + groupId).text(`Total Expense: ₹${totalExpense.toFixed(2)}`);
            } else {
                expenseList.append("<li class='text-gray-500'>No expenses found.</li>");
                $("#total-expense-" + groupId).text('Total Expense: ₹0.00');
            }
        },
        error: function() {
            console.error("Failed to fetch expenses for group " + groupId);

        }
    });
}

function updateDashboard() {
    $.ajax({
        url: "/fetchDashboard", 
        type: "GET",
        dataType: "json",
        success: function(response) {
            // Update the dashboard elements
            $("#totalExpenses").text(`₹${response.total_expense}`);
            $("#highestExpense").text(`₹${response.max_expense}`);
            $("#thisMonthExpense").text(`₹${response.total_this_month}`);
        },
        error: function() {
            console.error("Failed to fetch dashboard data.");
        }
    });
}

$(document).ready(function() {
    
    fetchGroupsAndExpenses();
    updateDashboard();
});

</script>
</body>

</html>