<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-md overflow-hidden p-8 text-center">
            <!-- Icon -->
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            
            <!-- Title -->
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Access Denied</h1>
            
            <!-- Description -->
            <p class="text-gray-600 mb-8">
                You don't have permission to access this page.
                Please contact your administrator or try another account.
            </p>
            
            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/login" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                    Login with Different Account
                </a>
                <a href="/" class="px-6 py-3 border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-lg transition duration-200">
                    Return to Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>