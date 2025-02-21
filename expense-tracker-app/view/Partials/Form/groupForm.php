<button onclick="openGroupModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
    ➕ Add Group
</button>

<div id="groupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Add Group</h2>
        <form method="POST" action="/groups">
            <label class="block text-gray-700">Group Name</label>
            <input type="text" name="groupName" class="w-full border p-2 rounded mt-1">
            <?php if (isset($_SESSION['errors']['groupError'])): ?>
                <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 mt-5"><?= htmlspecialchars($_SESSION['errors']['groupError']) ?></div>
            <?php endif; ?>
            <div class="flex justify-end mt-4">
                <button type="button" onClick="closeGroupModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Submit</button>
            </div>
        </form>

    </div>
</div>

<script>
    function openGroupModal() {
         document.getElementById('groupModal').classList.remove('hidden');
    }

    function closeGroupModal(){
        document.getElementById('groupModal').classList.add('hidden');
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
        <?php if (isset($_SESSION['errors']['groupError'])): ?>
            document.getElementById('groupModal').classList.remove('hidden');
        <?php endif; ?>
    });
</script>