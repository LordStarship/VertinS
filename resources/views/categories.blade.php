<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>VertinS | Products</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<body>
    <div class="h-screen flex flex-row">
        <div class="w-2/12 flex flex-col bg-primary">
            <div class="h-1/6 flex flex-row items-center justify-center">
                <p class="text-secondary text-2xl font-bold">ADMIN LIST</p>
            </div>
            <div class="h-1/6 flex flex-col items-center justify-center">
                <p class="mt-4 text-secondary text-xl font-medium">{{ session('username') }}</p>
                <p class="mt-4 text-secondary text-lg font-normal">Admin</p>
            </div>
            <div class="h-3/6 flex flex-col items-center justify-center">
                <a href={{ route('categories')}} class="ml-4 mt-2 py-1 w-4/5 border bg-secondary rounded-md border-secondary flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src={{ asset('storage/img/category-inactive.png') }}>
                    <p class="ml-6 text-primary text-md font-medium">Category</p>
                </a>
                <a href={{ route('products')}} class="ml-4 mt-2 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src={{ asset('storage/img/products-active.png') }}>
                    <p class="ml-6 text-secondary text-md font-light">Products</p>
                </a>
                <a href={{ route('accounts')}} class="ml-4 mt-2 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src={{ asset('storage/img/account-info-active.png') }}>
                    <p class="ml-6 text-secondary text-md font-light">Account Info</p>
                </a>
            </div>
            <div class="h-1/6 flex flex-row items-center justify-center">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex flex-row cursor-pointer">
                        <p class="mr-2 text-secondary text-md font-bold">Logout</p>
                        <img class="w-6" src={{ asset('storage/img/logout-icon.png') }}>
                    </button>
                </form>
            </div>
        </div>
        <div class="p-8 w-10/12 flex flex-col">
            <div class="h-2/6 flex flex-col">
                <div class="pb-4 flex flex-row w-full border-b-2 border-gray-300">
                    <p class="text-primary text-3xl font-bold">Categories List</p>
                    <div class="flex flex-row ml-auto">
                        <input type="text" id="search-input" placeholder="Search..." class="mr-4 pl-4 border border-secondary rounded-md" autocomplete="off">
                        <a href={{ route('categories.create')}} class="px-2 bg-primary rounded-md flex items-center justify-center cursor-pointer">
                            <p class="text-secondary text-md font-medium">Add New Category</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="h-4/6 overflow-x-auto">
                <table id="categoriesTable" class="min-w-full mt-4 border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Products</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-8 rounded-md w-1/3">
            <h2 class="text-center text-xl font-semibold mb-4">Edit Category</h2>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <input id="categoryName" type="text" name="name" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Category Name" required>
                <button type="submit" class="mt-4 bg-primary text-white w-full p-2 rounded-md">Ok</button>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-8 rounded-md w-1/3">
            <h2 class="text-center text-xl font-semibold mb-4">Confirm Delete</h2>
            <p class="text-center mb-6">Are you sure you want to delete this category?</p>
            <div class="flex justify-center">
                <button id="confirmDelete" class="mr-4 bg-red-500 text-white px-4 py-2 rounded-md">Ok</button>
                <button onclick="closeDeleteModal()" class="bg-gray-300 px-4 py-2 rounded-md">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#categoriesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('categories') }}",
                    error: function(xhr) {
                        console.error('DataTables AJAX error:', xhr.responseText);
                        alert('Failed to load data. Check the console for details.');
                    }
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'products_count', name: 'products_count', render: data => `${data} Products Used` },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('text-center'); 
                },
                drawCallback: function () {
                    $('#categoriesTable th').addClass('text-center');
                    $('#categoriesTable tbody td').addClass('text-center');
                }
            });
        });
        
        function openEditModal(id, name) {
            // Show the modal
            document.getElementById('editModal').classList.remove('hidden');
            
            // Pre-fill the input field with the current category name
            document.getElementById('categoryName').value = name;
            
            // Update the form action to the correct URL
            document.getElementById('editCategoryForm').action = `/categories/${id}`;
        }

        document.getElementById('editModal').addEventListener('click', function (event) {
            if (event.target === this) {
                closeEditModal();
            }
        });

        function closeEditModal() {
            // Hide the modal
            document.getElementById('editModal').classList.add('hidden');
        }

        document.getElementById('editCategoryForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const form = this;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Category updated successfully') {
                    // Close the modal
                    closeEditModal();

                    // Reload the categories table or update the list
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        let deleteCategoryId = null;

        function openDeleteModal(id) {
            // Store the category ID and show the delete modal
            deleteCategoryId = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            // Hide the delete modal and reset the category ID
            document.getElementById('deleteModal').classList.add('hidden');
            deleteCategoryId = null;
        }

        // Handle the delete confirmation button
        document.getElementById('confirmDelete').addEventListener('click', function () {
            if (deleteCategoryId) {
                // Submit the DELETE request using fetch
                fetch(`/categories/${deleteCategoryId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Category deleted successfully') {
                        // Refresh the table or reload page after deletion
                        location.reload();
                    } else {
                        alert('Failed to delete category.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
            closeDeleteModal();
        });

        // Close the modal by clicking outside it
        document.getElementById('deleteModal').addEventListener('click', function (event) {
            if (event.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>

