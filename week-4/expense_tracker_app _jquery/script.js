
function formatDate(date) {
    return date.toLocaleString('en-US', {
        weekday: 'long',  // Full weekday name (e.g., "Monday")
        year: 'numeric',  // Full year (e.g., "2025")
        month: 'long',    // Full month name (e.g., "February")
        day: 'numeric',   // Day of the month (e.g., "1")
        hour: '2-digit',  // Hour in 2-digit format (e.g., "10")
        minute: '2-digit',// Minute in 2-digit format (e.g., "30")
        hour12: true      // Use 12-hour time format with AM/PM
    });
}

function addGroupLocal_sto(groupName){
    let Groups_obj=JSON.parse(localStorage.getItem('Groups'))||[];
    
    let currentDate=new Date();
    let formattedDate = formatDate(currentDate);
    let newGroup={
        GroupName:groupName,
        CreatedAt:formattedDate,   
    }
    Groups_obj.push(newGroup);
    localStorage.setItem("Groups",JSON.stringify(Groups_obj));
    $("#group-name").val("");
    render_dashboard();
}



function renderGroupsLocal_sto(){
    let Groups_obj=JSON.parse(localStorage.getItem("Groups"));
    console.log("object",Groups_obj);
    $('#group-list').empty();
    Groups_obj.forEach(function(group) {
        let li = $('<li class="group_render"></li>');
        let div = $('<div class="render_ginfo"></div>');
        let groupname = $(`<p>${group.GroupName}</p>`); 
        let date = $(`<p><small>${group.CreatedAt}</small></p>`); 
        div.append(groupname, date);
        let editBtn = $('<button  class="group-btn edit-btn" data-group="'+group.GroupName+'" ></button>').text('Edit');
        let deleteBtn = $('<button class="group-btn delete-btn" data-group="'+group.GroupName+'"></button>').text('Delete');
        li.append(div, editBtn, deleteBtn);
        $('#group-list').append(li);
    });
}

$("#group-list").on("click", ".delete-btn", function(){
    let currentGroup = $(this).siblings(".render_ginfo").find("p:first").text().trim();
    deletegroupLocal_sto(currentGroup);
    renderGroupsLocal_sto();
    updateCatogery();
});
function deletegroupLocal_sto(currentGroup){
    let Groups_obj = JSON.parse(localStorage.getItem('Groups')) || [];
    let updatedGroups = Groups_obj.filter(group => group.GroupName.toLowerCase() !== currentGroup.toLowerCase());
    localStorage.setItem('Groups', JSON.stringify(updatedGroups));

    let Expense_obj = JSON.parse(localStorage.getItem('Expenses')) || [];
    let updated_array=Expense_obj.filter(function(group){
                  return (group.Category!=currentGroup);
    })
    localStorage.setItem("Expenses",JSON.stringify(updated_array));
    renderExpeseLocal_sto();
    render_dashboard();
}


$("#group-list").on("click", ".edit-btn", function(){
    let currentGroup = $(this).data('group');
    openEditModal(currentGroup);
});


function openEditModal(groupName) {
    $("#edit-group-name").val(groupName);
    $("#editModal").show();

    $("#edit-group-form").data('currentGroup', groupName);
}


$(".close").on("click", function() {
    $("#editModal").hide();
});

$("#edit-group-form").on("submit", function(e) {
    e.preventDefault();
    
    let newGroupName = $("#edit-group-name").val().trim();
    let currentGroup = $(this).data('currentGroup');

    if(newGroupName) {
        editGroupLocal_sto(currentGroup, newGroupName);
        renderGroupsLocal_sto();
        $("#editModal").hide();
        updateCatogery();
        
    }
});


function editGroupLocal_sto(currentGroup, newGroupName) {
    let Groups_obj = JSON.parse(localStorage.getItem('Groups')) || [];
    let group = Groups_obj.find(group => group.GroupName === currentGroup);
    let currentDate=new Date();
    let formattedDate = currentDate.toLocaleString('en-US', {
       weekday: 'long',  // Full weekday name (e.g., "Monday")
       year: 'numeric',  // Full year (e.g., "2025")
       month: 'long',    // Full month name (e.g., "February")
       day: 'numeric',   // Day of the month (e.g., "1")
       hour: '2-digit',  // Hour in 2-digit format (e.g., "10")
       minute: '2-digit',// Minute in 2-digit format (e.g., "30")
       hour12: true      // Use 12-hour time format with AM/PM
   });
    if (group) {
        group.GroupName = newGroupName;
        group.CreatedAt=formattedDate;
        localStorage.setItem('Groups', JSON.stringify(Groups_obj));
    }
   
    let Expense_obj = JSON.parse(localStorage.getItem('Expenses')) || [];
    Expense_obj.forEach(function(group){
              console.log(group.Category);
                if(group.Category === currentGroup){
                    group.Category=newGroupName;
                }
                console.log(group.Category);
    })
    localStorage.setItem("Expenses",JSON.stringify(Expense_obj));
    renderExpeseLocal_sto();
    render_dashboard();
}


function updateCatogery(){
    let Groups_obj=JSON.parse(localStorage.getItem('Groups'))||[];
    $('#expense-category').empty();
    Groups_obj.forEach(function(group){
        let category_name = group.GroupName;
        let option = $(`<option value="${category_name}">${category_name}</option>`);
        $('#expense-category').append(option);
    });
    render_dashboard();
}

function addExpenseLocal_sto(ExpenseName,ExpenseCat,ExpenseDate,ExpenseAmount){
    console.log("objecteeeee");
    let Expense_obj=JSON.parse(localStorage.getItem('Expenses'))||[];
    let inputDate = new Date(ExpenseDate);
    let formattedDate =inputDate.toLocaleString('en-US', {
       weekday: 'long',  // Full weekday name (e.g., "Monday")
       year: 'numeric',  // Full year (e.g., "2025")
       month: 'long',    // Full month name (e.g., "February")
       day: 'numeric',   // Day of the month (e.g., "1")
       hour: '2-digit',  // Hour in 2-digit format (e.g., "10")
       minute: '2-digit',// Minute in 2-digit format (e.g., "30")
       hour12: true      // Use 12-hour time format with AM/PM
   });
    let currentExpense={
        Name:ExpenseName,
        Category:ExpenseCat,
        Date:formattedDate,
        Amount:ExpenseAmount
    }
    Expense_obj.push(currentExpense);
    localStorage.setItem('Expenses',JSON.stringify(Expense_obj));
    $('#expense-name').val("");
    $('#expense-category').val("");
    $('#expense-date').val("");
    $('#expense-amount').val("");
    render_dashboard();
}



function renderExpeseLocal_sto() {
    let Expense_obj = JSON.parse(localStorage.getItem('Expenses')) || [];
    $('#expense-list').empty();
    Expense_obj.forEach(function(Exgroup) {
        let li = $('<li class="expense_render"></li>');
        let div = $('<div class="render_exinfo"></div>');
        let groupname = $(`<p>${Exgroup.Name}</p>`); 
        let date = $(`<p><small>${Exgroup.Date}</small></p>`); 
        div.append(groupname, date);
        let amount = $(`<p class="amount">&#8377;${Exgroup.Amount}</p>`); 
        let category = $(`<p class="category" data-cat=${Exgroup.Category}>${Exgroup.Category}</p>`);
        let editBtn = $(`<button class="expense-btn edit-btn" data-expense_edit="${Exgroup.Name}-${Exgroup.Category}-${Exgroup.Date}-${Exgroup.Amount}"></button>`).text('Edit');
        let deleteBtn = $(`<button class="expense-btn delete-btn" data-expense="${Exgroup.Name}-${Exgroup.Category}-${Exgroup.Date}"></button>`).text('Delete');
        li.append(div, category, amount, editBtn, deleteBtn);
        $('#expense-list').append(li);
    });
    render_dashboard();
}
$("#expense-list").on("click",".delete-btn",function(){
   
    let currentExpense = $(this).data('expense');
    let x=currentExpense.split('-');
    delete_expese_local(x[0],x[1],x[2]);
    renderExpeseLocal_sto();
});
function delete_expese_local(currentExpense,currentCategory,Expensedate){
   
    let Expense_obj = JSON.parse(localStorage.getItem("Expenses")) || [];
    
      let expense_group=Expense_obj.filter(function(expense){
             return !(expense.Name===currentExpense && expense.Category===currentCategory && expense.Date===Expensedate);
      })
      
      localStorage.setItem("Expenses",JSON.stringify(expense_group));
      renderExpeseLocal_sto();
      render_dashboard();
}

$("#expense-list").on("click",".edit-btn",function(){
    let currentExpense = $(this).data('expense_edit');
    let x=currentExpense.split('-');
  
    open_edit_Form(x[0],x[1],x[2],x[3]);
  
    
});
function open_edit_Form(expensename,expensecategory,expensedate,expenseamount){
   
    $('#edit-expense-name').val(expensename);
    $('#edit-expense-category').val(expensecategory);
    $('#edit-expense-amount').val(expenseamount);
    $('.modal_edit').show();

   let Groups_obj=JSON.parse(localStorage.getItem('Groups'))||[];
    $('#edit-expense-category').empty();
    Groups_obj.forEach(function(group){
        let category_name = group.GroupName;
        let option = $(`<option value="${category_name}">${category_name}</option>`);
        $('#edit-expense-category').append(option);
    });
    
    let old_data={
        name:expensename,
        category:expensecategory,
        date:expensedate,
        amount:expenseamount
    }
     
    $("#edit-expense-form").data("old_data_of_expense",old_data);

}
$('.close').on('click',function(){
    console.log("objectop");
    $('.modal_edit').hide();
});
$("#edit-expense-form").submit(function(e){
    e.preventDefault();
    let newexpsense=$('#edit-expense-name').val();
    let newcatogery=$('#edit-expense-category').val();
    let newdate=$('#edit-expense-date').val();
    let newamount=$('#edit-expense-amount').val();
    let olddata=$(this).data('old_data_of_expense');
    edit_expese_local(newexpsense,newcatogery,newdate,newamount,olddata);
    $('.modal_edit').hide();
})
function edit_expese_local(expensename,expensecategory,expensedate,expenseamount,old_data){4
        let Expense_obj = JSON.parse(localStorage.getItem("Expenses")) || [];
        console.log("gp",Expense_obj);
        let group=Expense_obj.find(function(group){
              return ((group.Name===old_data.name) && (group.Category===old_data.category) && (group.Date===old_data.date) && (group.Amount===old_data.amount));
        })
       
        let inputDate = new Date(expensedate);
        let formattedDate =inputDate.toLocaleString('en-US', {
           weekday: 'long',  // Full weekday name (e.g., "Monday")
           year: 'numeric',  // Full year (e.g., "2025")
           month: 'long',    // Full month name (e.g., "February")
           day: 'numeric',   // Day of the month (e.g., "1")
           hour: '2-digit',  // Hour in 2-digit format (e.g., "10")
           minute: '2-digit',// Minute in 2-digit format (e.g., "30")
           hour12: true      // Use 12-hour time format with AM/PM
       });
        if(group){
            group.Name=expensename,
            group.Category=expensecategory,
            group.Date=formattedDate,
            group.Amount=expenseamount

            localStorage.setItem("Expenses",JSON.stringify(Expense_obj));
            renderExpeseLocal_sto(); 
            render_dashboard();
        }else{
            alert("group is not found for updateing the edited info...");
        }

        
}

function render_dashboard(){
    let Groups_obj = JSON.parse(localStorage.getItem('Groups')) || [];
    let Expense_obj = JSON.parse(localStorage.getItem('Expenses')) || [];
    let list = $('#group-expenses-list-dash');
    console.log("render dashboeard");
    list.empty();  // Clear the existing list
    let total_expense_group=0;
    let highest_expense=0;

    Groups_obj.forEach(function(group){
        let groupExpenses=Expense_obj.filter(function(expense){
             return expense.Category===group.GroupName;
        })
        console.log("object",groupExpenses);
        let totalExpenses=0;
        let highestExpense=0;
        groupExpenses.forEach(function(expense){
            totalExpenses=totalExpenses+parseFloat(expense.Amount);
            highestExpense=Math.max(highestExpense,parseFloat(expense.Amount));
       })
       total_expense_group=total_expense_group+totalExpenses;
       highest_expense=Math.max(highest_expense,highestExpense);
        let li = $('<li></li>').addClass('group-item');
        let button = $('<button></button>').text(group.GroupName).addClass('group-button');
        let total = $('<span></span>').html(`Total: &#8377;${totalExpenses}`).addClass('total-expense');
        let highest = $('<span></span>').html(`Highest: &#8377;${highestExpense}`).addClass('highest-expense');
        let detailsButton = $('<button></button>').text('View Details').addClass('view-details-button');
        li.append(button).append(total).append(highest).append(detailsButton);
        list.append(li);
    });
    let this_month=0;
    Expense_obj.forEach(function(group){
         
         const inputDate = new Date();
         let formattedDate =inputDate.toLocaleString('en-US', {
            weekday: 'long',  // Full weekday name (e.g., "Monday")
            year: 'numeric',  // Full year (e.g., "2025")
            month: 'long',    // Full month name (e.g., "February")
            day: 'numeric',   // Day of the month (e.g., "1")
            hour: '2-digit',  // Hour in 2-digit format (e.g., "10")
            minute: '2-digit',// Minute in 2-digit format (e.g., "30")
            hour12: true      // Use 12-hour time format with AM/PM
        });
        let array_formatted_date=formattedDate.split(',');
        let array_formatted_group_date=group.Date.split(',');
        let array_formatted_date_month = array_formatted_date[1].split(" ");
        let array_formatted_group_date_month=array_formatted_group_date[1].split(" ");
        if(array_formatted_date_month[1]===array_formatted_group_date_month[1]){
              
             this_month=this_month+parseFloat(group.Amount);
            
        }
    })
    $('#total-expenses').text(total_expense_group);
    $('#highest-expense').text(highest_expense);
    $('#this-month-expense').text(this_month);
}
$(document).on('click','.view-details-button',function(){
    let groupName=$(this).siblings('.group-button').text();
    console.log("groupName",groupName);
    let Expense_obj = JSON.parse(localStorage.getItem('Expenses')) || [];
    let details=Expense_obj.filter(function(expense){
        return expense.Category===groupName;
   });
   console.log("groupExpense",details);
   let maindiv=$('<div></div>').addClass('expense-details');
   let table=$('<table></table>').addClass('expense-table');
   let thead = $('<thead></thead>');
   let tbody = $('<tbody></tbody>');
   thead.append(`<tr>
    <th>Name</th>
    <th>Amount</th>
    <th>Date</th>
    </tr> `);
   details.forEach(function(group){
    let row=$('<tr></tr>');
    row.append($('<td></td>').text(group.Name));
    row.append($('<td></td>').text(group.Amount));
    row.append($('<td></td>').text(group.Date));
    tbody.append(row);
    
   });
   table.append(thead);
   table.append(tbody);
   maindiv.append(table);
   let closeButton = $('<button></button>').text('Close').addClass('close-details');
   maindiv.append(closeButton);
   
   $('body').append(maindiv);
});
$(document).on('click', '.close-details', function() {
    $('.expense-details').remove();
});



$(document).ready(function() {
   
    $.validator.addMethod("uniqueGroupName",function(value){
        let Groups_obj = JSON.parse(localStorage.getItem('Groups')) || [];
        let exist=Groups_obj.some(group=>group.GroupName.toLowerCase()===value.toLowerCase());
        return !exist;
    },"Group with this name already exists!");

    $('#group-form').validate({
        rules: {
            'group-name': {
                required: true,
                uniqueGroupName: true,
            }
        },
        messages: {
            'group-name': {
                required:"Group name is required",
                uniqueGroupName: "Group with this name already exists!"
            }
           
        },
        errorClass: "error",
        highlight: function(element) {
            $(element).addClass('error');
        },
        unhighlight: function(element) {
            $(element).removeClass('error');
        },

        submitHandler: function(form) {
            let groupName = $("#group-name").val().trim();
           console.log(groupName);
            if (groupName) {
                addGroupLocal_sto(groupName);
                renderGroupsLocal_sto();
                updateCatogery();
            }

            return false; 
        }
    });

    $('#expense-form').validate({
        rules: {
            'expense-name': {
                required: true
            },
            'expense-category': {
                required: true
            },
            'expense-amount': {
                required: true,
                number: true
            },
            'expense-date': {
                required: true,
                date: true
            }
        },
        messages: {
            'expense-name': "Expense name is required",
            'expense-category': "Expense category is required",
            'expense-amount': "Expense amount is required",
            'expense-date': "Expense date is required"
        },
        errorClass:"error",
        highlight: function(element) {
            $(element).addClass('error');
        },
        unhighlight: function(element) {
            $(element).removeClass('error');
        },
        
        submitHandler: function(form) {
            let ExpenseName = $("#expense-name").val().trim();
            let ExpenseCat = $("#expense-category").val().trim();
            let ExpenseDate = $("#expense-date").val().trim();
            let ExpenseAmount = $("#expense-amount").val().trim();
            console.log(ExpenseName,ExpenseAmount,ExpenseCat,ExpenseDate);
          
            
                addExpenseLocal_sto(ExpenseName,ExpenseCat,ExpenseDate,ExpenseAmount);
                renderExpeseLocal_sto();
            

            return false; 
        }
    });
    renderGroupsLocal_sto();
    renderExpeseLocal_sto(); 
    updateCatogery();
    render_dashboard();
  
    
});
