<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>VertinS | Account Info</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://kit.fontawesome.com/7a5b7d67a3.js" crossorigin="anonymous"></script>
</head>
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
            <div class="h-3/6 flex flex-col items-center justify-center space-y-3">
                <a href="{{ route('categories.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/category-active.png') }}" alt="Category Icon">
                    <p class="ml-4 text-secondary text-base font-light">Category</p>
                </a>
                <a href="{{ route('products.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/products-active.png') }}" alt="Products Icon">
                    <p class="ml-4 text-secondary text-base font-light">Products</p>
                </a>
                
                <a href="{{ route('accounts') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary bg-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/account-info-inactive.png') }}" alt="Account Info Icon">
                    <p class="ml-4 text-primary text-base font-medium">Account Info</p>
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
        <div class="p-8 w-10/12 overflow-y-scroll flex flex-col">
            <div class="h-1/6 flex flex-col">
                <div class="pb-4 w-full border-b-2 border-gray-300">
                    <p class="text-primary text-3xl font-bold">Account Info</p>
                </div>
            </div>
            <div class="h-2/6">
                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <p class="mr-8 text-primary text-lg font-medium">Username</p>
                        <input class="border border-grey-600 text-primary text-center font-medium" disabled value="{{ session('username') }}"></p>
                    </div>
                    <div class="mt-4 flex flex-row">
                        <p class="mr-8 text-primary text-lg font-medium">Email</p>
                        <input class="border border-grey-600 text-primary text-center font-medium" disabled value="{{ session('useremail') }}"></p>
                    </div>
                    <button onclick="openEditUserModal()" class="w-1/6 mt-4 py-2 bg-primary text-secondary rounded-md">Edit</button>
                </div>                
            </div>
            <div class="h-1/6 flex flex-col">
                <div class="pb-4 w-full border-b-2 border-gray-300">
                    <p class="text-primary text-3xl font-bold">Admins List</p>
                </div>
            </div>
            <div class="h-2/6 flex flex-col">
                <button onclick="openAddAdminModal()" class="mb-4 w-1/6 py-2 bg-primary text-secondary rounded-md">Add Admin</button>
                <div class="h-full">
                    <table id="adminsTable" class="w-full text-left border-collapse border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Admin Modal -->
        <div id="editUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-md w-1/3">
                <h2 class="text-center text-xl font-semibold mb-4">Edit Account Info</h2>
                <form id="editUserForm" method="POST" action="{{ route('account.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="username" class="block text-primary font-medium">Username</label>
                        <input id="username" type="text" name="name" class="w-full p-2 border border-gray-300 rounded-md" value="{{ session('username') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-primary font-medium">Email</label>
                        <input id="email" type="email" name="email" class="w-full p-2 border border-gray-300 rounded-md" value="{{ session('useremail') }}" required>
                    </div>
                    <button type="submit" class="mt-4 bg-primary text-white w-full p-2 rounded-md">Save</button>
                </form>
            </div>
        </div>

        <div id="addAdminModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-md w-1/3">
                <h2 class="text-center text-xl font-semibold mb-4">Add New Admin</h2>
                <form id="addAdminForm" method="POST" action="{{ route('admins.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-primary font-medium">Username</label>
                        <input id="name" type="text" name="name" class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-primary font-medium">Email</label>
                        <input id="email" type="email" name="email" class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-primary font-medium">Password</label>
                        <input id="password" type="password" name="password" class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <button type="submit" class="mt-4 bg-primary text-white w-full p-2 rounded-md">Add Admin</button>
                </form>
            </div>
        </div>

        <!-- Edit Admin Modal -->
        <div id="editAdminModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-md w-1/3">
                <h2 class="text-center text-xl font-semibold mb-4">Edit Admin</h2>
                <form id="editAdminForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="editAdminName" class="block text-primary font-medium">Name</label>
                        <input id="editAdminName" type="text" name="name" class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="editAdminEmail" class="block text-primary font-medium">Email</label>
                        <input id="editAdminEmail" type="email" name="email" class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <button type="submit" class="mt-4 bg-primary text-white w-full p-2 rounded-md">Save</button>
                </form>
            </div>
        </div>

        <!-- Delete Admin Modal -->
        <div id="deleteAdminModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-md w-1/3 text-center">
                <h2 class="text-xl font-semibold mb-4">Delete Admin</h2>
                <p>Are you sure you want to delete this admin?</p>
                <form id="deleteAdminForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                    <button type="button" onclick="closeDeleteAdminModal()" class="mt-4 bg-gray-300 text-black px-4 py-2 rounded-md">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            $('#adminsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('accounts') }}",
                    error: function(xhr) {
                        console.error('DataTables AJAX error:', xhr.responseText);
                        alert('Failed to load data. Check the console for details.');
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
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

        function openAddAdminModal() {
            document.getElementById('addAdminModal').classList.remove('hidden');
        }

        function closeAddAdminModal() {
            document.getElementById('addAdminModal').classList.add('hidden');
        }

        function openEditUserModal() {
            document.getElementById('editUserModal').classList.remove('hidden');
        }

        function closeEditUserModal() {
            document.getElementById('editUserModal').classList.add('hidden');
        }

        function openEditAdminModal(admin) {
        const editAdminForm = document.getElementById('editAdminForm');
        editAdminForm.action = `/admins/${admin.id}`;
        document.getElementById('editAdminName').value = admin.name;
        document.getElementById('editAdminEmail').value = admin.email;
        document.getElementById('editAdminModal').classList.remove('hidden');
        }

        function closeEditAdminModal() {
            document.getElementById('editAdminModal').classList.add('hidden');
        }

        function openDeleteAdminModal(adminId) {
            document.getElementById('deleteAdminModal').classList.remove('hidden');
            document.getElementById('deleteAdminForm').action = `/admin/${adminId}`;
        }

        function closeDeleteAdminModal() {
            document.getElementById('deleteAdminModal').classList.add('hidden');
        }
        
        document.getElementById('addAdminModal').addEventListener('click', function (event) {
            if (event.target === this) {
                closeAddAdminModal();
            }
        });

        document.getElementById('editAdminModal').addEventListener('click', function (event) {
            if (event.target === this) {
                closeEditAdminModal();
            }
        });

        document.getElementById('deleteAdminModal').addEventListener('click', function (event) {
            if (event.target === this) {
                closeDeleteAdminModal();
            }
        });

    </script>
</body>
</html>