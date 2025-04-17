<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-200" style="font-family: 'Poppins', sans-serif;">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="max-w-md w-full bg-gray-800 rounded-lg shadow-xl overflow-hidden border border-gray-700">
            <!-- Header section with gradient accent -->
            <div class="bg-gradient-to-r from-red-500 to-purple-600 h-4"></div>
            
            <div class="p-8">
                <div class="flex justify-center mb-6">
                    <div class="text-center">
                        <h1 class="text-8xl font-bold text-white">404</h1>
                        <div class="w-16 h-1 mx-auto bg-gradient-to-r from-red-500 to-purple-600 my-4"></div>
                    </div>
                </div>
                
                <h2 class="text-2xl font-bold text-center text-white mb-4">Page Not Found</h2>
                
                <p class="text-center text-gray-400 mb-8">
                    Oops! The page you are looking for doesn't exist or has been moved.
                </p>
                
                <div class="flex justify-center">
                    <button 
                        id="redirectButton"
                        class="px-6 py-3 bg-gradient-to-r from-red-500 to-purple-600 text-white font-medium rounded-md transition-all duration-300 hover:shadow-lg hover:shadow-red-500/20 transform hover:-translate-y-1"
                        onclick="goBack()">
                        Go Back
                    </button>
                </div>
            </div>
            
            <div class="bg-gray-900 py-4 px-6 border-t border-gray-700">
                <p class="text-center text-gray-500 text-sm">
                    Error Code: 404 | Request ID: <span class="font-mono">REQ-4042-NF</span>
                </p>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
            
            setTimeout(function() {
                if (document.referrer === '') {
                    window.location.href = '/manager/dashboard';
                }
            }, 100);
        }
    </script>
</body>
</html>