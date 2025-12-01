<?php
require_once "../includes/functions_courses.php";

$courses = getAllCourses();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Management</title>

    <!-- TailwindCss -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <link rel="stylesheet" href="./src/output.css">
<script src="./js/courses.js" defer></script>
</head>

<body class="bg-gray-100">

<header class="bg-blue-600 text-white p-4 shadow">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <h1 class="text-2xl font-bold">Courses</h1>
        <a href="index.php" class="hover:underline">Dashboard</a>
    </div>
</header>

<main class="container mx-auto mt-6 px-4">

    <!-- Form -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl mb-4 font-semibold">Add Course</h2>

        <form id="course-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input class="p-3 border rounded" name="name" placeholder="Course Name" required>
            <select class="p-3 border rounded" name="category_id" required></select>

            <input type="date" class="p-3 border rounded" name="course_date" required>
            <input type="time" class="p-3 border rounded" name="course_time" required>

            <input type="number" class="p-3 border rounded" name="duration" placeholder="Duration" required>
            <input type="number" class="p-3 border rounded" name="max_participants" placeholder="Max Participants" required>

            <button class="col-span-full bg-blue-600 text-white p-3 rounded hover:bg-blue-700">
                Add Course
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white p-6 rounded shadow mt-6">
        <h2 class="text-xl mb-4 font-semibold">Courses List</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3">Name</th>
                        <th class="p-3">Category</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Time</th>
                        <th class="p-3">Duration</th>
                        <th class="p-3">Max</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody id="courses-table">
                    <!-- JS inject rows -->
                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>
