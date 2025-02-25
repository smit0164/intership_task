<div id="editGroupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Edit Group</h2>
        <form id="editGroupForm" method="POST">
            <input type="hidden" name="id" id="editGroupId">
            <input type="hidden" name="_method" value="PATCH">
            <label class="block mb-2">Group Name:</label>
            <input type="text" name="editGroupName" id="editGroupName" class="w-full border p-2 rounded">

            <div id="editGroupError" class="text-red-500 text-sm mt-2"></div>

            <div class="flex justify-end mt-4">
                <button type="button" onClick="closeEditGroupModal()" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openGroupEditModal(groupId, groupName) {
        $('#editGroupName').val(groupName);
        $('#editGroupId').val(groupId);
        $('#editGroupModal').removeClass('hidden');
    }

    function closeEditGroupModal() {
        let form=$('#editGroupForm');
        form.trigger("reset");
        form.validate().resetForm();
        $('#editGroupModal').addClass('hidden');
        $('#editGroupName').removeClass("error-input");
        $('#editGroupError').text('');
    }

    $(document).ready(function() {
    $('#editGroupForm').validate({
        rules: {
            editGroupName: { 
                required: true,
                minlength: 3,
                remote: {
                    url: "/checkGroupName",
                    type: "POST",
                    data: {
                        groupName: function() {
                            return $("#editGroupName").val().trim();
                        },
                        groupId: function() {
                            return $("#editGroupId").val().trim();
                        }
                    },
                }
            }
        },
        messages: {
            editGroupName: {
                required: "Group name is required",
                minlength: "Group name must be at least 3 characters long",
                remote: "Group name already exists!"
            }
        },
        errorClass: "error-text",
        errorPlacement: function(error, element) {
           $("#editGroupError").text(error.text());
            element.addClass("error-input");
        },
        success: function(label, element) {
            $("#editGroupError").text('');
            $(element).removeClass("error-input");
        },
        
        submitHandler: function(form, event) {
            event.preventDefault();
            let formData = $("#editGroupForm").serialize();
            $.ajax({
                url: '/editGroup', 
                type: 'POST',
                data: formData,
                success: function(response) {
                   if(response.success){
                    showToast("Group Updated successfully!");
                    closeEditGroupModal();
                    fetchGroupsAndExpenses();
                   }else{
                    showErrorToast(response.error);
                   }
                   
                    
                },
                error: function(xhr) {
                    let errorMsg = (xhr.responseJSON && xhr.responseJSON.error) ? xhr.responseJSON.error : "Server error";
                    showErrorToast(errorMsg);
                }
            });
        }
    });
});

</script>