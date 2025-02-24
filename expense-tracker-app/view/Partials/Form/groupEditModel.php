<button onClick="openEditGroupModal('<?= htmlspecialchars($groupName) ?>','<?= $group['groupId'] ?>')"
    class="text-blue-500 hover:text-blue-700">
    ✏️ Edit
</button>

<div id="editGroupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Edit Group</h2>
        <form id="editGroupForm" method="POST">
            <input type="hidden" name="id" id="editGroupId">

            <label class="block mb-2">Group Name:</label>
            <input type="text" name="editGroupName" id="editGroupName" class="w-full border p-2 rounded">

            <div id="editGroupError" class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 mt-5 hidden"></div>

            <div class="flex justify-end mt-4">
                <button type="button" onClick="closeEditGroupModal()" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
  function openEditGroupModal(groupName, groupId) {
        $('#editGroupName').val(groupName);
        $('#editGroupId').val(groupId);
        $('#editGroupModal').removeClass('hidden');
    }

    function closeEditGroupModal() {
        $('#editGroupModal').addClass('hidden');
        $('#editGroupError').addClass('hidden').text('');
        
        // Reset validation error styles when closing the modal
        $('#editGroupName').removeClass('border-red-500');
        $('#editGroupError').addClass('hidden').text('');
    }

    $(document).ready(function() {
        $('#editGroupForm').validate({
            debug: true,
            rules: {
                editGroupName: { // Corrected input name
                    required: true,
                    minlength: 3,
                    remote: {
                        url: "/checkGroupName",
                        type: "POST",
                        data: {
                            groupName: function() {
                                return $("#editGroupName").val();
                            },
                            groupId: function() {
                                return $("#editGroupId").val();
                            }
                        },
                        dataType: "json",
                        beforeSend: function() {
                            console.log("📡 Remote validation request is about to be sent!");
                        },
                        complete: function(response) {
                            console.log("🔍 Remote Validation Response:", response);
                        }
                    }
                }
            },
            messages: {
                editGroupName: {
                    required: "Group name is required",
                    minlength: "Group name must be at least 3 characters long",
                    remote: "Group name is already taken!"
                }

            },
            errorPlacement: function(error, element) {
                $("#editGroupError").removeClass('hidden').text(error.text());
                element.addClass('border-red-500');
            },
            success: function(label, element) {
                $("#editGroupError").addClass('hidden').text('');
                $(element).removeClass('border-red-500');
            },
            submitHandler: function(form) {
                console.log("✅ Submit handler triggered!");
            console.log("✅ Submit handler triggered!");

            let formData = $(form).serialize();
            console.log("📝 Form Data:", formData);
            }
        });
    });
</script>