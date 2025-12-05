<?php

require_once __DIR__ . "/../includes/functions_data/functions_courses.php";
require_once __DIR__ . "/../includes/functions_data/functions_equip.php";

// COURSE EQUIPMENT
require_once __DIR__ . "/../includes/functions_data/functions_course_equipment.php";

$links = getAllCourseEquipment();
$allCourses = getAllCourses();
$allEquipments = getAllEquipments();

$total_courses = getTotalCourses();
$total_equipments = getTotalEquipments();

$upcomming_courses = getUpcomingCourses();
$total_upcoming_month = getUpcomingCoursesThisMonth();


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

            <!-- upcoming courses in this month -->
            <div class="bg-white shadow rounded p-6 flex flex-col items-center">
                <h2 class="text-gray-500">Upcoming Courses This Month</h2>
                <span class="text-4xl font-bold text-purple-600">
                    <?= htmlspecialchars($total_upcoming_month) ?>
                </span>
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
                    <tbody id="courses-table">
                        <?php foreach ($upcomming_courses as $course): ?>
                            <tr class="border-b">
                                <td class="p-3 text-center"><?= htmlspecialchars($course['name']) ?></td>
                                <td class="p-3 text-center"><?= htmlspecialchars($course['category_name']) ?></td>
                                <td class="p-3 text-center"><?= htmlspecialchars($course['course_date']) ?></td>
                                <td class="p-3 text-center"><?= htmlspecialchars($course['course_time']) ?></td>
                                <td class="p-3 text-center"><?= htmlspecialchars($course['duration']) ?> min</td>
                                <td class="p-3 text-center"><?= htmlspecialchars($course['max_participants']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- COURSE EQUIPMENT -->
        <!-- COURSE–EQUIPMENT LINK TABLE -->
        <div class="bg-white p-6 shadow rounded mt-10">
            <h2 class="text-xl font-semibold mb-4">Course - Equipment Links</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3">Course</th>
                            <th class="p-3">Category</th>
                            <th class="p-3">Equipment</th>
                            <th class="p-3">Type</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($links as $row): ?>
                            <tr class="border-b">
                                <td class="p-3 text-center"><?= htmlspecialchars($row["course_name"]) ?></td>
                                <td class="p-3 text-center"><?= htmlspecialchars($row["category_name"]) ?></td>
                                <td class="p-3 text-center"><?= htmlspecialchars($row["equipment_name"]) ?></td>
                                <td class="p-3 text-center"><?= htmlspecialchars($row["type_name"]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

        <!-- ADD NEW LINK -->
        <div class="bg-white p-6 shadow rounded mt-6">
            <h2 class="text-xl font-semibold mb-4">Add New Course - Equipment Link</h2>

            <form class="grid grid-cols-1 md:grid-cols-2 gap-4" method="POST" action="../includes/add_course_equipment.php">

                <select name="course_id" class="p-3 border rounded" required>
                    <option value="" disabled selected>Select Course</option>
                    <?php foreach ($allCourses as $c): ?>
                        <option value="<?= htmlspecialchars($c['id']) ?>">
                            <?= htmlspecialchars($c['name']) ?> (<?= htmlspecialchars($c['category_name']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="equipment_id" class="p-3 border rounded" required>
                    <option value="" disabled selected>Select Equipment</option>
                    <?php foreach ($allEquipments as $e): ?>
                        <option value="<?= htmlspecialchars($e['id']) ?>">
                            <?= htmlspecialchars($e['name']) ?> - <?= htmlspecialchars($e['type_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button
                    type="submit"
                    class="col-span-full bg-purple-600 text-white py-3 rounded hover:bg-purple-700 hover:cursor-pointer">
                    Add Link
                </button>
            </form>
        </div>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>