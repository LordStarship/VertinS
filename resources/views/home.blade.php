<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin CRUD</title>
    <style>
        /* CSS Styles */
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        .success { color: green; }
        .error { color: red; }
        button { padding: 10px 15px; margin: 5px; }
        input[type="text"], input[type="email"], input[type="password"] {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            box-sizing: border-box;
        }
        button[disabled] {
            background-color: grey;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin CRUD</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add/Edit Admin Form Section -->
        <div id="formContainer">
            <!-- Add Admin Form -->
            <div id="addContainer">
                <h2>Add Admin</h2>
                <form action="{{ route('home.add') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" id="addPassword" placeholder="Password minimum 8 characters" required>
                    <button type="submit" id="addAdminButton" disabled>Add Admin</button>
                </form>
            </div>

            <!-- Edit Admin Form (Hidden by Default) -->
            <div id="editContainer" style="display:none;">
                <h2>Edit Admin</h2>
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <input type="text" id="editName" name="name" placeholder="Name" required>
                    <input type="email" id="editEmail" name="email" placeholder="Email" required>
                    <input type="password" id="editPassword" name="password" placeholder="New Password (optional)">
                    <input type="password" id="editPasswordConfirmation" name="password_confirmation" placeholder="Confirm New Password (optional)" disabled>
                    <button type="submit" id="editAdminButton">Update Admin</button>
                    <button type="button" onclick="cancelEdit()">Cancel</button>
                </form>
            </div>
        </div>

        <h2>Admins List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            <button onclick="editAdmin({{ $admin->id }}, '{{ $admin->name }}', '{{ $admin->email }}')">Edit</button>
                            
                            @if($admin->id != 1)
                            <!-- Add Delete Button Except for Admin with ID 1 -->
                            <form action="{{ route('home.delete', $admin->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('index2') }}">
            <button type="button">Go to Index 2</button>
        </a>
    </div>

    <script>
        // Add Admin form: Disable the button if password is less than 8 characters
        document.getElementById('addPassword').addEventListener('input', function() {
            const addPassword = document.getElementById('addPassword').value;
            const addAdminButton = document.getElementById('addAdminButton');
            addAdminButton.disabled = addPassword.length < 8;
        });

        // Edit Admin form logic
        const editPasswordField = document.getElementById('editPassword');
        const editPasswordConfirmationField = document.getElementById('editPasswordConfirmation');
        const editAdminButton = document.getElementById('editAdminButton');

        editPasswordField.addEventListener('input', function() {
            const editPassword = editPasswordField.value;

            // Enable the confirm password field only if the password is at least 8 characters
            if (editPassword.length >= 8) {
                editPasswordConfirmationField.disabled = false;
            } else {
                editPasswordConfirmationField.disabled = true;
                editPasswordConfirmationField.value = ''; // Clear the confirmation field
            }

            // Check if password and confirm password match
            checkPasswords();
        });

        editPasswordConfirmationField.addEventListener('input', function() {
            // Check if password and confirm password match
            checkPasswords();
        });

        function checkPasswords() {
            const editPassword = editPasswordField.value;
            const confirmPassword = editPasswordConfirmationField.value;

            // If both passwords match or the password field is empty (optional), enable the button
            if (editPassword === confirmPassword || editPassword === '') {
                editAdminButton.disabled = false;
            } else {
                editAdminButton.disabled = true;
            }
        }

        function editAdmin(id, name, email) {
            // Hide the Add Admin form and show the Edit Admin form
            document.getElementById('addContainer').style.display = 'none';
            document.getElementById('editContainer').style.display = 'block';

            // Populate the Edit form with current values
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editForm').action = "{{ url('/home/update') }}" + '/' + id; // Update the action URL

            // Reset password fields and states when opening edit form
            editPasswordField.value = '';
            editPasswordConfirmationField.value = '';
            editPasswordConfirmationField.disabled = true;
            editAdminButton.disabled = false; // Enable the button since password is optional
        }

        function cancelEdit() {
            // Hide the Edit Admin form and show the Add Admin form
            document.getElementById('editContainer').style.display = 'none';
            document.getElementById('addContainer').style.display = 'block';
        }
    </script>
</body>
</html>
