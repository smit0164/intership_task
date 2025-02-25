  
<div class="flex justify-between mb-6">
<!-- Improved Persistent Toast UI -->
<div id="toastMessage" class="hidden fixed top-5 right-5 z-50 bg-green-600 text-white py-3 px-6 rounded-lg shadow-lg transition-all duration-500 transform -translate-y-4 opacity-0 flex items-center">
    <span id="toastText" class="text-lg font-semibold flex-grow">Group added successfully!</span>
    <button id="toastClose" class="ml-4 focus:outline-none" onclick="closeToast()">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 8.586l4.95-4.95a1 1 0 111.414 1.414L11.414 10l4.95 4.95a1 1 0 01-1.414 1.414L10 11.414l-4.95 4.95a1 1 0 01-1.414-1.414L8.586 10 3.636 5.05a1 1 0 011.414-1.414L10 8.586z" clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
<div id="errorToast" class="hidden fixed top-5 right-5 z-50 bg-red-600 text-white py-3 px-6 rounded-lg shadow-lg transition-all duration-500 transform -translate-y-4 opacity-0 flex items-center">
    <span id="errorToastText" class="text-lg font-semibold flex-grow">An error occurred!</span>
    <button id="errorToastClose" class="ml-4 focus:outline-none" onclick="closeErrorToast()">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 8.586l4.95-4.95a1 1 0 111.414 1.414L11.414 10l4.95 4.95a1 1 0 01-1.414 1.414L10 11.414l-4.95 4.95a1 1 0 01-1.414-1.414L8.586 10 3.636 5.05a1 1 0 011.414-1.414L10 8.586z" clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
<style>
    .error-input {
        border-color: red !important;
    }

    .error-text {
        color: red;
        font-size: 14px;
        margin-top: 4px;
    }
</style>
<script>
function showToast(message) {
    let toast = $("#toastMessage");
    toast.find("#toastText").text(message);
    toast.removeClass("hidden opacity-0").addClass("opacity-100 scale-100");

    setTimeout(() => {
        toast.removeClass("opacity-100").addClass("opacity-0");
        setTimeout(() => toast.addClass("hidden"), 500);
    }, 3000);
}

function closeToast() {
    let toast = $("#toastMessage");
    toast.removeClass("opacity-100").addClass("opacity-0");
    setTimeout(() => toast.addClass("hidden"), 500);
}
function showErrorToast(message) {
    let toast = $("#errorToast");
    toast.find("#errorToastText").text(message);
    toast.removeClass("hidden opacity-0").addClass("opacity-100 scale-100");

    setTimeout(() => {
        toast.removeClass("opacity-100").addClass("opacity-0");
        setTimeout(() => toast.addClass("hidden"), 500);
    }, 3000);
}

function closeErrorToast() {
    let toast = $("#errorToast");
    toast.removeClass("opacity-100").addClass("opacity-0");
    setTimeout(() => toast.addClass("hidden"), 500);
}
</script>


    <?php require_once basePath("view/Partials/Form/groupForm.php")?>
    <?php require_once basePath("view/Partials/Form/expenseForm.php")?> 
</div>


