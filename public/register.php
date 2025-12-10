<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-lg bg-white shadow-lg rounded-xl p-8">

        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Create Account</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="mb-4 text-red-600 text-center bg-red-100 p-2 rounded">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </p>
        <?php endif; ?>

        <form action="../app/auth/register.php" method="POST" class="space-y-4">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold">First Name</label>
                    <input type="text" name="first_name"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                        required />
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Last Name</label>
                    <input type="text" name="last_name"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                        required />
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Email</label>
                <input type="email" name="email"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                    required />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold">Gender</label>
                    <select name="gender"
                        class="w-full mt-1 px-4 py-2 border rounded-lg bg-white focus:ring focus:ring-blue-300 outline-none">
                        <option value="">Select</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Age</label>
                    <input type="number" name="age" min="10" max="120"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none" />
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Password</label>
                <input type="password" name="password" minlength="6"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                    required />
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Confirm Password</label>
                <input type="password" name="confirm_password" minlength="6"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                    required />
            </div>

            <!-- default role  -->
            <input type="hidden" name="role_id" value="2">

            <button type="submit"
                class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                Create Account
            </button>

        </form>

        <p class="mt-4 text-center text-gray-700">
            Already have an account?
            <a href="login.php" class="text-blue-600 hover:underline font-semibold">Login</a>
        </p>

    </div>

</body>

</html>
