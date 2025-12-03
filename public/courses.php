<?php
require_once __DIR__ . "/../includes/functions_data/functions_courses.php";


$courses = getAllCourses();
$categories = getAllCategories();


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
    <script src="../public/js/courses.js" defer></script>
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

        <!-- action="../includes/add_course.php" -->
        <form id="course-form" method="post"  class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input class="p-3 border rounded" name="name" placeholder="Course Name" required>
           <select class="p-3 border rounded" name="category_id" required>
                <option value="" disabled selected>Select Category</option>
                <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['id']) ?>">
                    <?= htmlspecialchars($category['name']) ?>
                </option>
                <?php endforeach; ?>
            </select>


            <input type="date" class="p-3 border rounded" name="course_date" required>
            <input type="time" class="p-3 border rounded" name="course_time" required>

            <input type="number" class="p-3 border rounded" name="duration" placeholder="Duration" required>
            <input type="number" class="p-3 border rounded" name="max_participants" placeholder="Max Participants" required>

            <button type="submit" class="col-span-full bg-blue-600 text-white p-3 rounded hover:bg-blue-700">
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
                <tbody>
                <?php foreach ($courses as $course): ?>
                     <tr class="border-b">
                        <td class="p-3 text-center"><?= htmlspecialchars($course['name']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($course['category_name']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($course['course_date']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($course['course_time']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($course['duration']) ?> min</td>
                        <td class="p-3 text-center"><?= htmlspecialchars($course['max_participants']) ?></td>


                        <td class="text-center p-3 space-x-2">
<a href="#" class="text-blue-600 hover:underline edit-btn" data-id="<?= $course['id'] ?>">
    Edit
</a>

                  <a class="text-red-600 hover:underline delete-btn"
                 href="#"
                data-id="<?= $course['id'] ?>">
                    Delete
                </a>

                </td>
                        
                        
                    </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Course Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded shadow-lg p-6 w-full max-w-md relative">
        <h2 class="text-xl mb-4 font-semibold">Edit Course</h2>
        <form id="edit-course-form" class="grid grid-cols-1 gap-4">
            <input type="hidden" name="id" id="edit-course-id">

            <input type="text" class="p-3 border rounded" name="name" id="edit-course-name" placeholder="Course Name" required>
            
            <select class="p-3 border rounded" name="category_id" id="edit-course-category" required>
                <option value="" disabled>Select Category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <input type="date" class="p-3 border rounded" name="course_date" id="edit-course-date" required>
            <input type="time" class="p-3 border rounded" name="course_time" id="edit-course-time" required>
            <input type="number" class="p-3 border rounded" name="duration" id="edit-course-duration" placeholder="Duration" required>
            <input type="number" class="p-3 border rounded" name="max_participants" id="edit-course-max" placeholder="Max Participants" required>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

</main>

</body>
</html>
