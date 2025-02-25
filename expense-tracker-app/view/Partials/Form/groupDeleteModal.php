<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Confirm Deletion</h2>
        <p>Are you sure you want to delete this group?</p>

        <form id="deleteForm" method="POST">
            <input type="hidden" name="_method" value="DELETE"> <!-- Required for your PHP routing -->
            <input type="hidden" name="groupId" id="deleteGroupId"> <!-- Store Group ID -->
        </form>

        <div class="mt-6 flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            <button onclick="confirmDelete() " class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
        </div>
    </div>
</div>
<script>
    function openDeleteModal(groupId) {
        $("#deleteGroupId").val(groupId);
        $("#deleteModal").removeClass("hidden");
    }

    function closeDeleteModal() {
        $("#deleteModal").addClass("hidden");
    }

    function confirmDelete() {
        let groupId = $("#deleteGroupId").val();
        $.ajax({
            url: "/deleteGroup",
            type: "POST",
            data: $("#deleteForm").serialize(),
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    closeDeleteModal();
                    showToast("Group deleted successfully!");
                    fetchGroupsAndExpenses();
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