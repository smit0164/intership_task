
<button onClick="openEditGroupModal('<?= htmlspecialchars($groupName)?>','<?=$group['groupId'] ?>')" 
        class="text-blue-500 hover:text-blue-700">
    ✏️ Edit
</button>


<div id="editGroupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Edit Group</h2>
<form id="editGroupForm" method="POST" action="/editGroup">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="id" id="editGroupId" value="<?= $_SESSION['groupId'] ?? '' ?>">
    
    <label class="block mb-2">Group Name:</label>
    <input type="text" name="groupName" id="editGroupName" class="w-full border p-2 rounded" 
           value="<?= htmlspecialchars($_SESSION['groupName'] ?? '') ?>">

    <?php if(isset($_SESSION['errors']['editGroupError'])): ?>
        <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 mt-5">
            <?= htmlspecialchars($_SESSION['errors']['editGroupError']) ?>
        </div>
    <?php endif; ?>

    <div class="flex justify-end mt-4">
        <button type="button" onClick="closeEditGroupModal()" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
    </div>
</form>

    </div>
</div>

<script>
  function openEditGroupModal(groupName, groupId) {
    document.getElementById('editGroupName').value = groupName;
    document.getElementById('editGroupId').value = groupId;
    document.getElementById('editGroupModal').classList.remove('hidden');
}

function closeEditGroupModal() {
    document.getElementById('editGroupModal').classList.add('hidden');
    fetch('/clear-errors.php', {
                cache: "no-store"
            })
            .then(response => response.text())
            .then(data => {
                console.log("Server Response:", data);
                location.reload();
            })
            .catch(error => console.error("Fetch Error:", error));
}

document.addEventListener("DOMContentLoaded", () => {
    <?php if(isset($_SESSION['errors']['editGroupError'])): ?>
        document.getElementById('editGroupModal').classList.remove('hidden');
    <?php endif; ?>
});

</script>