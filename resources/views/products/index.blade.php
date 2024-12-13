<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>VertinS | Products</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://kit.fontawesome.com/7a5b7d67a3.js" crossorigin="anonymous"></script>
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
                   class="py-2 w-4/5 flex items-center border border-secondary bg-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/products-inactive.png') }}" alt="Products Icon">
                    <p class="ml-4 text-primary text-base font-medium">Products</p>
                </a>
                <a href="{{ route('admins.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/admin-active.png') }}" alt="Account Info Icon">
                    <p class="ml-4 text-secondary text-base font-light">Admin List</p>
                </a>
                <a href="{{ route('accounts.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/account-info-active.png') }}" alt="Account Info Icon">
                    <p class="ml-4 text-secondary text-base font-light">Account Info</p>
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
                    <p class="text-primary text-3xl font-bold">Product List</p>
                    <div class="flex flex-row ml-auto">
                        <a href={{ route('products.create')}} class="px-2 bg-primary rounded-md flex items-center justify-center cursor-pointer">
                            <p class="  text-secondary text-md font-bold">Add New Product</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="h-5/6 overflow-x-auto">
                <table id="productsTable" class="w-full">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Tags</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>                    
                </table>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white rounded shadow-lg w-1/3 p-6 relative">
            <button onclick="closeDeleteModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                &times;
            </button>
            <h2 class="text-xl font-bold mb-4">Delete Product</h2>
            <p id="deleteMessage" class="mb-6"></p>
            <div class="flex justify-end gap-4">
                <button onclick="closeDeleteModal()" class="py-2 px-4 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded">Cancel</button>
                <button id="confirmDeleteButton" class="py-2 px-4 bg-red-500 hover:bg-red-600 text-white rounded">Delete</button>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function () {
        $('#productsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('products.index') }}",
                error: function(xhr) {
                    console.error('DataTables AJAX error:', xhr.responseText);
                    alert('Failed to load data. Check the console for details.');
                }
            },
            columns: [
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'categories_count', name: 'categories_count', render: data => `${data} Tags Embed` , orderable: false, searchable: false },
                { 
                    data: 'price', 
                    name: 'price',
                    render: function (data, type, row) {
                        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data);
                    }
                },
                { data: 'pictures_count', name: 'pictures_count', render: data => `${data} Pictures Embed` , orderable: false, searchable: false },
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

    let productIdToDelete = null;

    function openDeleteModal(productId, productName) {
        productIdToDelete = productId; 
        document.getElementById('deleteMessage').textContent = `Are you sure you want to delete the product "${productName}"?`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        productIdToDelete = null; 
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.getElementById('confirmDeleteButton').addEventListener('click', function () {
        if (productIdToDelete) {
            deleteProduct(productIdToDelete);
        }
    });
    
    function deleteProduct(productId) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        if (!csrfToken) {
            console.error('CSRF token not found. Make sure it is included in the <head> section.');
            alert('CSRF token missing. Please contact support.');
            return;
        }

        fetch(`/products/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to delete the product.');
                }
                return response.json();
            })
            .then(data => {
                alert(data.message || 'Product deleted successfully.');
                closeDeleteModal();
                location.reload(); 
            })
            .catch(error => {
                console.error(error);
                alert('An error occurred while deleting the product.');
            });
    }
</script>
