<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Unauthorized Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-lg w-full bg-white shadow-xl rounded-2xl p-10 text-center animate-fadeIn">

        
        <div class="flex justify-center mb-6">
            <div class="bg-red-100 p-5 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="red" class="w-16 h-16">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m0 3.75h.008v.008H12V16.5Zm9.75-4.5a9.75 9.75 0 11-19.5 0 9.75 9.75 0 0119.5 0Z" />
                </svg>
            </div>
        </div>

        
        <h1 class="text-3xl font-extrabold text-gray-900 mb-3">
            Access Denied
        </h1>

        <p class="text-gray-700 text-lg mb-6">
            You do not have permission to view this page.<br>
            Please contact the administrator if you believe this is an error.
        </p>


        <?php if (isset($_SESSION["fullname"])): ?>
            <p class="text-gray-600 mb-4">
                Logged in as: <strong><?= htmlspecialchars($_SESSION["fullname"]) ?></strong>
            </p>
        <?php endif; ?>


        <div class="flex flex-col sm:flex-row gap-3 justify-center">

            <a href="index.php"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Go to Dashboard
            </a>

            <a href="../app/auth/logout.php"
                class="bg-gray-300 text-gray-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">
                Logout
            </a>
        </div>
    </div>

    <style>

        .animate-fadeIn {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

</body>

</html>