<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-200" style="font-family: 'Poppins', sans-serif;">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="max-w-md w-full bg-gray-800 rounded-lg shadow-xl overflow-hidden border border-gray-700">
            <!-- Header section with warning pattern -->
            <div class="bg-gradient-to-r from-red-500 to-purple-600 h-4"></div>
            
            <div class="p-8 text-center">
                <!-- Icon -->
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gray-700 mb-6 border-2 border-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                
                <h1 class="text-3xl font-bold text-white mb-2">Access Denied</h1>
                
                <p class="text-gray-400 mb-8 text-lg">
                    You don't have permission to access this resource.
                    <span class="block mt-2 text-sm">Please verify your credentials or contact support.</span>
                </p>
                
                <div class="flex flex-col gap-4 justify-center">
                    <a href="/login" class="px-6 py-3 bg-gradient-to-r from-red-500 to-purple-600 text-white font-medium rounded-md transition-all duration-300 hover:shadow-lg hover:shadow-red-500/20 transform hover:-translate-y-1">
                        Try Different Credentials
                    </a>
                    <a class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-gray-200 font-medium rounded-md transition duration-300 border border-gray-600">
                       Go Back
                    </a>
                </div>
            </div>
            
            <!-- Footer with technical info -->
            <div class="bg-gray-900 py-3 px-6 border-t border-gray-700">
                <p class="text-center text-gray-500 text-xs">
                    Error Code: 403 | Request ID: <span class="font-mono">ACL-7891-DX</span>
                </p>
            </div>
        </div>
    </div>

</body>
</html>