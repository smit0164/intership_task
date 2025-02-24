<button onclick="openGroupModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
    ➕ Add Group
</button>

<div id="groupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Add Group</h2>
        <form method="POST" action="/groups" id="groupForm">
            <label class="block text-gray-700">Group Name</label>
            <input type="text" name="groupName" id="groupName" class="w-full border p-2 rounded mt-1">
            <div class="text-red-500 text-sm mt-2" id="errorMessage"></div> <!-- Error message container -->
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeGroupModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" id="submitGroup"class="px-4 py-2 bg-blue-500 text-white rounded">Submit</button>
            </div>
        </form>
    </div>
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
    function openGroupModal() {
        $('#groupModal').removeClass("hidden");
    }

    function closeGroupModal() {
        let form = $('#groupForm');
        $('#groupModal').addClass("hidden");

        // Reset form fields
        form.trigger("reset");
        form.validate().resetForm();

        // Remove error styling
        $('#groupName').removeClass("error-input");
        $('#errorMessage').text('');
    }

    $(document).ready(function() {
        $("#groupForm").validate({
            rules: {
                groupName: {
                    required: true,
                    remote: {
                        url: "/validate-group",
                        type: "POST",
                        data: {
                            groupName: () => $('#groupName').val().trim()
                        }
                    }
                }
            },
            messages: {
                groupName: {
                    required: "Group name is required",
                    remote: "Group name already exists!"
                }
            },
            errorClass: "error-text",
            errorPlacement: function(error, element) {
                $('#errorMessage').text(error.text());
                element.addClass("error-input");
            },
            success: function(label, element) {
                $('#errorMessage').text('');
                $(element).removeClass("error-input");
            },
            submitHandler: function(form, event) {
                event.preventDefault();

                let formData = $("#groupForm").serialize();

                
                $.ajax({
                    url: "/groups",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            showToast("✅ Group added successfully!");
                            closeGroupModal();
                            fetchGroupsAndExpenses();
                        } else {
                            $('#errorMessage').text(response.error || "An error occurred.");
                            $('#groupName').addClass("error-input");
                        }
                    },
                    error: function(xhr) {
                        $('#errorMessage').text(xhr.responseJSON?.error || "Server error.");
                        $('#groupName').addClass("error-input");
                    },
                    
                });
            }
        });
    });

    function showToast(message) {
        let toast = $("#toastMessage");
        toast.text(message).removeClass("hidden opacity-0").addClass("opacity-100 scale-100");

        setTimeout(() => {
            toast.removeClass("opacity-100").addClass("opacity-0");
            setTimeout(() => toast.addClass("hidden"), 500);
        }, 3000);
    }
</script>
