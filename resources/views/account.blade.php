<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>VertinS | Account Info</title>
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
            <div class="h-3/6 flex flex-col items-center justify-center">
                <a href="{{ route('categories')}}" class="ml-4 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src="img/category-active.png">
                    <p class="ml-6 text-secondary text-md font-light">Category</p>
                </a>
                <a href="{{ route('products')}}" class="ml-4 mt-2 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src="img/products-active.png">
                    <p class="ml-6 text-secondary text-md font-light">Products</p>
                </a>
                <a href="{{ route('accounts')}}" class="ml-4 mt-2 py-1 w-4/5 border bg-secondary rounded-md border-secondary flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src="img/account-info-inactive.png">
                    <p class="ml-6 text-primary text-md font-medium">Account Info</p>
                </a>
            </div>
            <div class="h-1/6 flex flex-row items-center justify-center">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex flex-row cursor-pointer">
                        <p class="mr-2 text-secondary text-md font-bold">Logout</p>
                        <img class="w-6" src="img/logout-icon.png">
                    </button>
                </form>
            </div>
        </div>
        <div class="p-8 w-10/12 flex flex-col">
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
                <div class="overflow-y-scroll h-full">
                    <table class="w-full text-left border-collapse border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-2 border border-gray-300">ID</th>
                                <th class="p-2 border border-gray-300">Name</th>
                                <th class="p-2 border border-gray-300">Email</th>
                                <th class="p-2 border border-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                @if($admin->id !== 1)
                                    <tr>
                                        <td class="p-2 border border-gray-300">{{ $admin->id }}</td>
                                        <td class="p-2 border border-gray-300">{{ $admin->name }}</td>
                                        <td class="p-2 border border-gray-300">{{ $admin->email }}</td>
                                        <td class="p-2 border border-gray-300">
                                            <button onclick="openEditAdminModal({{ json_encode(['id' => $admin->id, 'name' => $admin->name, 'email' => $admin->email]) }})" class="mr-2 px-4 py-1 bg-blue-500 text-white rounded-md">Edit</button>
                                            <button onclick="openDeleteAdminModal({{ $admin->id }})" class="px-4 py-1 bg-red-500 text-white rounded-md">Delete</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
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
    </script>
</body>
</html>
