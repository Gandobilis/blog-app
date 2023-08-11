<!-- The delete modal -->
<div id="myModal" class="modal hidden fixed inset-0 flex justify-center items-center z-50">
    <div class="bg-white rounded shadow-lg p-6 w-80">
        <h2 class="text-lg font-semibold mb-2">Confirm Delete</h2>
        <p class="mb-4">Are you sure you want to delete this item?</p>
        <form method="post" action="">
            <button type="submit" name="delete" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">Delete</button>
            <button type="button" onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded ml-2">Cancel</button>
        </form>
    </div>
</div>
