
<button onclick="openGroupDeleteModal('<?=$group['groupId'] ?>')" class="text-red-500 hover:text-red-700">🗑️ Delete</button>
<div id="deleteGroupModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm text-center">
        <h3 class="text-lg font-semibold mb-4">Confirm Delete</h3>
        <p class="text-gray-600 mb-4">Are you sure you want to delete this group?</p>
        
        <form id="deleteForm" method="POST" action="/deleteGroup">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" id="deleteGroupId">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700">Delete</button>
            <button type="button" onclick="closeGroupDeleteModal()" class="ml-2 text-gray-600 hover:text-gray-900">Cancel</button>
        </form>
    </div>
</div>
 
<script>
function openGroupDeleteModal(groupId) {
    document.getElementById('deleteGroupId').value = groupId;
    document.getElementById('deleteGroupModal').classList.remove('hidden');
}

function closeGroupDeleteModal() {
    document.getElementById('deleteGroupModal').classList.add('hidden');
}
</script>