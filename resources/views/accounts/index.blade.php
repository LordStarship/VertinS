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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div class="h-screen flex flex-row">
        <div class="w-2/12 flex flex-col bg-primary">
            <div class="h-1/6 flex flex-row items-center justify-center">
                <a href={{route('home')}}>
                    <div class="flex-shrink-0">
                        <img class="h-32 w-32" src={{ asset('storage/img/logo-user-2.png') }} alt="VertinS Logo">
                    </div>
                </a>
            </div>
            <div class="h-1/6 flex flex-col items-center justify-center">
                <p class="mt-4 text-secondary text-xl font-medium">Welcome, {{ session('username') }}!</p>
                <p class="mt-4 text-secondary text-lg font-normal italic">
                    {{ session('role') == 0 ? 'Superadmin' : 'Admin' }}
                </p>
            </div>
            <div class="h-3/6 flex flex-col items-center justify-center space-y-3">
                <a href="{{ route('categories.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-gray-500">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/category-active.png') }}" alt="Category Icon">
                    <p class="ml-4 text-secondary text-base font-light">Category</p>
                </a>
                <a href="{{ route('products.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-gray-500">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/products-active.png') }}" alt="Products Icon">
                    <p class="ml-4 text-secondary text-base font-light">Products</p>
                </a>
                @if (session('role') == 0)
                    <a href="{{ route('admins.index') }}" 
                       class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-gray-500">
                        <img class="w-5 ml-4" src="{{ asset('storage/img/admin-active.png') }}" alt="Admin List Icon">
                        <p class="ml-4 text-secondary text-base font-light">Admin List</p>
                    </a>
                @endif
                <a href="{{ route('accounts.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary bg-secondary rounded-md cursor-pointer">
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
                <div class="pb-4 flex flex-row w-full border-b-2 border-gray-300">
                    <p class="text-primary text-3xl font-bold">Account Info</p>
                </div>
            </div>
            <div class="h-4/6 flex flex-col">
                <div class="flex flex-row">
                    <p class="mr-8 text-primary text-lg font-medium">Username</p>
                    <input class="border border-grey-600 text-primary text-center font-medium" disabled value="{{ session('username') }}"></p>
                </div>
                <div class="mt-4 flex flex-row">
                    <p class="mr-8 text-primary text-lg font-medium">Email</p>
                    <input class="border border-grey-600 text-primary text-center font-medium" disabled value="{{ session('useremail') }}"></p>
                </div>
                <div class="flex">
                    <button onclick="openChangePasswordModal()" class="mt-8 p-2 px-8 bg-primary font-medium rounded-md text-secondary flex items-center justify-center cursor-pointer hover:bg-primary-passive">Change Password</button>
                </div>  
                <div class="pb-4 flex flex-row w-full border-b-2 border-gray-300">

                </div>
                <div class="mt-4">
                    <div class="flex">
                        <button onclick="openAddMediaModal()" class="mb-4   x p-2 px-8 bg-primary font-medium rounded-md text-secondary flex items-center justify-center cursor-pointer hover:bg-primary-passive">Add New Media</button>
                    </div> 
                    <table id="mediaTable" class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="text-center">Social Media</th>
                                <th class="text-center">URL</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>     
                <div class="flex flex-row ml-auto">
                    <button onclick="openEditUserModal()" class="mt-16 mb-4 p-2 px-8 bg-primary font-medium rounded-md text-secondary flex items-center justify-center cursor-pointer hover:bg-primary-passive">Edit</button>
                </div>    
            </div>
        </div>

        <div id="addMediaModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-md w-1/3">
                <h2 class="text-center text-xl font-semibold mb-4">Add Social Media</h2>
                <form id="addMediaForm" method="POST" action="{{ route('medias.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="type" class="block text-primary font-medium">Social Media</label>
                        <input id="type" type="text" name="social_media" class="w-full p-2 border border-gray-300 rounded-md" placeholder="e.g., Twitter" required>
                    </div>
                    <div class="mb-4">
                        <label for="url" class="block text-primary font-medium">URL</label>
                        <input id="url" type="url" name="url" class="w-full p-2 border border-gray-300 rounded-md" placeholder="e.g., https://twitter.com/yourprofile" required>
                    </div>
                    <button type="submit" class="mt-4 bg-primary text-white w-full p-2 rounded-md hover:bg-primary-passive">Save</button>
                    <button type="button" onclick="closeAddMediaModal()" class="mt-4 bg-gray-300 text-black w-full p-2 rounded-md hover:bg-gray-400">Cancel</button>
                </form>
            </div>
        </div>

        <div id="editMediaModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-md w-1/3">
                <h2 class="text-center text-xl font-semibold mb-4">Add Social Media</h2>
                <form id="editMediaForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit-social-media" class="block text-primary font-medium">Social Media</label>
                        <input id="edit-social-media" type="text" name="edit-social-media" class="w-full p-2 border border-gray-300 rounded-md" disabled required>
                    </div>
                    <div class="mb-4">
                        <label for="edit-url" class="block text-primary font-medium">URL</label>
                        <input id="edit-url" type="url" name="url" class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <button type="submit" class="mt-4 bg-primary text-white w-full p-2 rounded-md hover:bg-primary-passive">Save</button>
                    <button type="button" onclick="closeEditMediaModal()" class="mt-4 bg-gray-300 text-black w-full p-2 rounded-md hover:bg-gray-400">Cancel</button>
                </form>
            </div>
        </div>

        <div id="deleteMediaModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-md w-1/3">
                <h2 class="text-center text-xl font-semibold mb-4">Confirm Delete</h2>
                <p class="text-center mb-6">Are you sure you want to delete this category?</p>
                <div class="flex justify-center">
                    <button id="confirmDelete" class="mr-4 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700">Ok</button>
                    <button onclick="closeDeleteMediaModal()" class="bg-gray-300 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                </div>
            </div>
        </div>

        <div id="editUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-md w-1/3">
                <h2 class="text-center text-xl font-semibold mb-4">Edit Account Info</h2>
                <form id="editUserForm" method="POST" action="{{ route('accounts.update', auth('web')->id()) }}">
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
                    <button type="submit" class="mt-4 bg-primary text-white w-full p-2 rounded-md hover:bg-primary-passive">Save</button>
                </form>
            </div>
        </div>
        
        <div id="changePasswordModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-md w-1/3">
                <h2 class="text-center text-xl font-semibold mb-4">Change Your Password</h2>
                <form id="changePasswordForm" method="POST" action="{{ route('accounts.change-password') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="old_password" class="block text-primary font-medium">Old Password</label>
                        <input id="old_password" type="password" name="old_password" class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="new_password" class="block text-primary font-medium">New Password</label>
                        <input id="new_password" type="password" name="new_password" class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="confirm_new_password" class="block text-primary font-medium">Confirm New Password</label>
                        <input id="confirm_new_password" type="password" name="confirm_new_password" class="w-full p-2 border border-gray-300 rounded-md" required>
                        <small id="passwordMismatchError" class="text-red-500 hidden">Passwords do not match.</small>
                    </div>
                    <button type="submit" id="submitBtn" class="mt-4 bg-gray-400 text-white w-full p-2 rounded-md cursor-not-allowed" disabled>
                        Save
                    </button>
                </form>
            </div>
        </div>        

    </div>
</body>
</html>
<script>
    $(document).ready(function () {
        $('#mediaTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('accounts.index') }}",
                error: function(xhr) {
                    console.error('DataTables AJAX error:', xhr.responseText);
                    alert('Failed to load data. Check the console for details.');
                }
            },
            columns: [
                { data: 'social_media', name: 'social_media' },
                { data: 'url', name: 'url'},
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            createdRow: function(row, data, dataIndex) {
                $(row).addClass('text-center'); 
            },
            drawCallback: function () {
                $('#mediaTable th').addClass('text-center');
                $('#mediaTable tbody td').addClass('text-center');
            }
        });
    });

    function openEditUserModal() {
        document.getElementById('editUserModal').classList.remove('hidden');
    }

    function closeEditUserModal() {
        document.getElementById('editUserModal').classList.add('hidden');
    }

    function openAddMediaModal() {
        document.getElementById('addMediaModal').classList.remove('hidden');
    }

    function closeAddMediaModal() {
        document.getElementById('addMediaModal').classList.add('hidden');
    }

    document.getElementById('editUserModal').addEventListener('click', function (event) {
        if (event.target === this) {
            closeEditUserModal();
        }
    });

    function openEditMediaModal(media) {
        document.getElementById('editMediaModal').classList.remove('hidden');
        document.getElementById('edit-social-media').value = media.social_media;
        document.getElementById('edit-url').value = media.url;
        document.getElementById('editMediaForm').action = `/medias/${media.id}`;
    }

    function closeEditMediaModal() {
        document.getElementById('editMediaModal').classList.add('hidden');
    }

    let deleteMediaId = null;

    function openDeleteMediaModal(id) {
        deleteMediaId = id;
        document.getElementById('deleteMediaModal').classList.remove('hidden');
    }

    function closeDeleteMediaModal() {
        document.getElementById('deleteMediaModal').classList.add('hidden');
        deleteMediaId = null;
    }

    document.getElementById('confirmDelete').addEventListener('click', function () {
        if (deleteMediaId) {
            fetch(`/categories/${deleteMediaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Media deleted successfully') {
                    location.reload();
                } else {
                    alert('Failed to delete media.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
        closeDeleteModal();
    });

    function openChangePasswordModal() {
        const modal = document.getElementById('changePasswordModal');
        modal.classList.remove('hidden');

        // Lazy load the script if it's not already initialized
        if (!modal.dataset.initialized) {
            const newPassword = document.getElementById('new_password');
            const confirmNewPassword = document.getElementById('confirm_new_password');
            const submitBtn = document.getElementById('submitBtn');
            const error = document.getElementById('passwordMismatchError');

            function validatePasswords() {
                if (newPassword.value === confirmNewPassword.value && newPassword.value !== '') {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                    submitBtn.classList.add('bg-primary', 'cursor-pointer', 'hover:bg-primary-passive');
                    error.classList.add('hidden');
                } else {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                    submitBtn.classList.remove('bg-primary', 'cursor-pointer');
                    if (confirmNewPassword.value !== '') {
                        error.classList.remove('hidden');
                    }
                }
            }

            newPassword.addEventListener('input', validatePasswords);
            confirmNewPassword.addEventListener('input', validatePasswords);

            // Mark the modal as initialized to avoid re-binding the listeners
            modal.dataset.initialized = true;
        }
    }

    function closeChangePasswordModal() {
        document.getElementById('changePasswordModal').classList.add('hidden');
    }


    document.querySelectorAll('.fixed').forEach(modal => {
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>