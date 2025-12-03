<?php

require_once "../includes/functions_equip.php";
$equipments = getAllEquipments();
$states = getAllStates();
$types = getAllTypes();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Management</title>

    <!-- Tailwind CSS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <link rel="stylesheet" href="./src/output.css">
    <script src="../public/js/equipments.js" defer></script>
</head>

<body class="bg-gray-100">

<!-- Header -->
<header class="bg-green-600 text-white p-4 shadow">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center gap-3">
        <h1 class="text-2xl font-bold">Equipments</h1>
        <a href="index.php" class="hover:underline text-lg">Dashboard</a>
    </div>
</header>


<main class="container mx-auto px-4 mt-6">

    <!-- Add Equipment Form -->
    <div class="bg-white p-6 shadow rounded mb-6">
        <h2 class="text-xl font-semibold mb-4">Add New Equipment</h2>

        <form id="equipment-form" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <input 
                type="text" 
                name="name" 
                placeholder="Equipment Name" 
                class="p-3 border rounded-md w-full"
                required
            >

            <select 
                name="type_id" 
                class="p-3 border rounded-md w-full"
                required
            >
             <option value="" disabled selected>Choose Equipment Type</option>
                <?php foreach ($types as $type): ?>
                <option value="<?= htmlspecialchars($type['id']) ?>">
                    <?= htmlspecialchars($type['type_name']) ?>
                </option>
                <?php endforeach; ?>
            </select>

            <input 
                type="number" 
                name="quantity" 
                placeholder="Quantity"
                class="p-3 border rounded-md w-full"
                required
            >

            <select 
                name="state_id" 
                class="p-3 border rounded-md w-full"
                required
            >
                <option value="" disabled selected>Choose State</option>
                <?php foreach ($states as $state): ?>
                <option value="<?= htmlspecialchars($state['id']) ?>">
                    <?= htmlspecialchars($state['state_name']) ?>
                </option>
                <?php endforeach; ?>
            </select>

            <button 
                type="submit" 
                class="col-span-full bg-green-600 text-white py-3 rounded hover:bg-green-700 transition"
            >
                Add Equipment
            </button>
        </form>
    </div>


    <!-- Equipment Table -->
    <div class="bg-white p-6 shadow rounded">
        <h2 class="text-xl font-semibold mb-4">Equipment List</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Quantity</th>
                        <th class="px-4 py-3">State</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody id="equipments-table">
                     <?php foreach ($equipments as $equip): ?>
                     <tr class="border-b">
                        <td class="p-3 text-center"><?= htmlspecialchars($equip['name']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($equip['type_name']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($equip['quantity']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($equip['state_name']) ?></td>
                       
                    </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

</body>
</html>
