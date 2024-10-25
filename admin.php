<?php
session_start();
include 'config/database.php';

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$db = new Database();
$conn = $db->conectar();

$query = $conn->prepare("SELECT * FROM login");
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Events In Sound</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7e99496f14.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-black p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-white font-bold text-lg">
                <i class="fa-solid fa-music"></i> Events In Sound - Admin Panel
            </div>
            <div class="flex items-center">
                <span class="text-white mr-4">Bienvenido, Admin</span>
                <a href="login.php" class="text-white bg-red-500 hover:bg-red-700 font-bold py-2 px-4 rounded">
                    <i class="fa-solid fa-sign-out-alt"></i> Cerrar sesión
                </a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-5">Panel de Administración</h1>
        <div class="bg-white shadow-md rounded mb-6">
            <div class="flex justify-between items-center p-4 bg-blue-900 text-white rounded-t">
                <h2 class="text-2xl">Usuarios Definidos</h2>
                <button onclick="toggleModal('addModal')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa-solid fa-user-plus"></i> Agregar Usuario
                </button>
            </div>
            <table class="table-auto w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Usuario</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Rol</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($user['id']); ?></td>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($user['usuario']); ?></td>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($user['role']); ?></td>
                        <td class="border px-4 py-2">
                            <div class="flex space-x-2">
                                <button onclick="openEditModal('<?php echo $user['id']; ?>', '<?php echo $user['usuario']; ?>', '<?php echo $user['email']; ?>', '<?php echo $user['role']; ?>')" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fa-solid fa-edit"></i> Modificar
                                </button>
                                <form action="delete_user.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        <i class="fa-solid fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para agregar usuario -->
    <div id="addModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="bg-blue-900 p-4 text-white">
                    <h2 class="text-2xl">Agregar Usuario</h2>
                </div>
                <form action="add_user.php" method="POST" class="p-4">
                    <div class="mb-4">
                        <label class="block text-gray-700">Usuario</label>
                        <input type="text" name="usuario" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Contraseña</label>
                        <input type="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Rol</label>
                        <select name="role" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="toggleModal('addModal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancelar</button>
                        <button type="submit" class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar usuario -->
    <div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="bg-yellow-500 p-4 text-white">
                    <h2 class="text-2xl">Modificar Usuario</h2>
                </div>
                <form id="editForm" action="edit_user.php" method="POST" class="p-4">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-4">
                        <label class="block text-gray-700">Usuario</label>
                        <input type="text" id="editUsuario" name="usuario" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" id="editEmail" name="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Rol</label>
                        <select id="editRole" name="role" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="toggleModal('editModal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancelar</button>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        function openEditModal(id, usuario, email, role) {
            document.getElementById('editId').value = id;
            document.getElementById('editUsuario').value = usuario;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRole').value = role;
            toggleModal('editModal');
        }
    </script>
</body>
</html>
