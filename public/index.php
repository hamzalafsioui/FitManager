<?php
require_once __DIR__ . "/../includes/functions_courses.php";
require_once __DIR__ . "/../includes/functions_equip.php";

$total_courses = getTotalCourses();
$total_equipments = getTotalEquipments();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit Manager Dashboard</title>

    <!-- Tailwind CSS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <link rel="stylesheet" href="./src/output.css">

    <script src="js/dashboard.js" defer></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-blue-600 text-white p-4 shadow">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center gap-3">
            <h1 class="text-2xl font-bold">Fit Manager Dashboard</h1>

            <nav class="flex gap-4 text-lg">
                <a href="courses.php" class="hover:underline">Courses</a>
                <a href="equipments.php" class="hover:underline">Equipments</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 mt-6">


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Card course -->
            <div class="bg-white shadow rounded p-6 flex flex-col items-center">
                <h2 class="text-gray-500">Total Courses</h2>
                <span id="total-courses" class="text-4xl font-bold text-blue-600">
                     <?= htmlspecialchars($total_courses) ?>
                </span>
            </div>
            <!-- Card equipments -->

            <div class="bg-white shadow rounded p-6 flex flex-col items-center">
                <h2 class="text-gray-500">Total Equipments</h2>
                <span id="total-equipments" class="text-4xl font-bold text-green-600">
                     <?= htmlspecialchars($total_equipments) ?>
                </span>
            </div>

            <!-- Card category -->
            <div class="bg-white shadow rounded p-6">
                <h2 class="text-gray-500 text-center">Courses by Category</h2>
                <canvas id="coursesChart" class="w-full h-56"></canvas>
            </div>

        </div>

    
        <div class="mt-8 bg-white shadow rounded p-6">
            <h2 class="text-xl font-semibold mb-4">Upcoming Courses</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3">Name</th>
                            <th class="p-3">Category</th>
                            <th class="p-3">Date</th>
                            <th class="p-3">Time</th>
                            <th class="p-3">Duration</th>
                            <th class="p-3">Max Participants</th>
                        </tr>
                    </thead>
                    <tbody id="courses-table"></tbody>
                </table>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
