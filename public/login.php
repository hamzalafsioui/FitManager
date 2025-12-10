<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">

        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Login</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="mb-4 text-red-600 text-center bg-red-100 p-2 rounded">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </p>
        <?php endif; ?>

        <form action="../app/auth/login.php" method="POST" class="space-y-4">

            <div>
                <label class="block text-gray-700 font-semibold">Email</label>
                <input type="email" name="email"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                    required />
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Password</label>
                <input type="password" name="password"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                    required />
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                Login
            </button>

        </form>

        <p class="mt-4 text-center text-gray-700">
            Don't have an account?
            <a href="register.php" class="text-blue-600 hover:underline font-semibold">Create one</a>
        </p>

    </div>

</body>

</html>