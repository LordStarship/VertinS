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
                <a href="{{ route('admins.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/admin-active.png') }}" alt="Account Info Icon">
                    <p class="ml-4 text-secondary text-base font-light">Admin List</p>
                </a>
                <a href="{{ route('accounts.index') }}" 
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
                <div class="pb-4 flex flex-row w-full border-b-2 border-gray-300">
                    <p class="text-primary text-3xl font-bold">Account Info</p>
                </div>
            </div>
            <div class="h-5/6 flex flex-row">
                <div class="w-1/2 flex flex-col">
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
                <div class="w-1/2 flex flex-col">
                    @if($media->isNotEmpty())
                        <h3 class="text-primary text-lg font-bold mb-4">Social Media</h3>
                        @foreach($media as $m)
                            <div class="flex flex-row items-center mb-2">
                                <p class="mr-8 text-primary text-lg font-medium">{{ $m->social_media }}</p>
                                <input class="border border-grey-600 text-primary text-center font-medium flex-1" disabled value="{{ $m->url }}">
                            </div>
                            <button onclick="openAddMediaModal()" class="w-1/6 mt-4 py-2 bg-primary text-secondary rounded-md">Add</button>
                            <button onclick="openEditMediaModal({{ $m->id }})" class="w-1/6 mt-4 py-2 bg-primary text-secondary rounded-md">Edit</button>
                        @endforeach                      
                    @else
                        <p class="text-primary text-md">No social media added yet. Click the button below to add one!</p>
                        <button onclick="openAddMediaModal()" class="mt-4 py-2 bg-primary text-secondary rounded-md">
                            Add Social Media
                        </button>
                    @endif
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
                    <button type="submit" class="mt-4 bg-primary text-white w-full p-2 rounded-md">Save</button>
                    <button type="button" onclick="closeAddMediaModal()" class="mt-4 bg-gray-300 text-black w-full p-2 rounded-md">Cancel</button>
                </form>
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
                    <button type="submit" class="mt-4 bg-primary text-white w-full p-2 rounded-md">Save</button>
                </form>
            </div>
        </div>

        <!-- Edit Media Modal -->
        <div id="editMediaModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-md w-1/3">
                <h2 class="text-center text-xl font-semibold mb-4">Edit Social Media</h2>
                @foreach($media as $m)
                    <div class="flex flex-row items-center mb-2">
                        <form id="editMediaForm" method="POST" action="{{ route('medias.update', $m->id) }}">
                            @csrf
                            @method('PUT')
                            <p class="mr-8 text-primary text-lg font-medium">{{ $m->social_media }}</p>
                            <input 
                                name="url" 
                                class="border border-grey-600 text-primary text-center font-medium flex-1" 
                                value="{{ $m->url }}"
                            >
                            <button type="submit" class="ml-4 py-1 px-3 bg-primary text-secondary rounded-md">
                                Save
                            </button>
                        </form>
                    </div>
                @endforeach       
            </div>
        </div>

    </div>
</body>
</html>
<script>
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

    function openEditMediaModal(id) {
        console.log(`Fetching media with ID: ${id}`); // Log the ID
        fetch(`/medias/${id}`)
            .then(response => {
                console.log('Response:', response); // Log the response object
                if (!response.ok) {
                    throw new Error(`Failed to fetch. Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Fetched Data:', data); // Log the fetched data
                const { social_media, url } = data.data;
                document.getElementById('edit-social-media').value = social_media;
                document.getElementById('edit-url').value = url;
                document.getElementById('editMediaModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error(error);
                alert('Failed to fetch social media details.');
            });
    }    

    function closeEditMediaModal() {
        document.getElementById('editMediaModal').classList.add('hidden');
    }

    function deleteMedia(mediaId) {
        if (confirm('Are you sure you want to delete this social media?')) {
            $.ajax({
                url: `/medias/${mediaId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                }
            });
        }
    }
</script>