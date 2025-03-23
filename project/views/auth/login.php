<!DOCTYPE html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MerchCalc Pro - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-blue-50 to-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="flex w-full max-w-4xl rounded-xl shadow-2xl overflow-hidden bg-white">
        <!-- Left side banner with image and headline -->
        <div class="hidden md:block md:w-1/2 bg-gradient-to-br from-transparent to-blue-800 p-12 text-white relative">
            <div class="absolute inset-0 opacity-40">
                <img src="https://i.pinimg.com/736x/cd/31/44/cd314421329d3e78cd67d8abae40b7da.jpg"
                    alt="Merchandising background" class="w-full h-full object-cover" />
            </div>
            <div class="relative z-10">
                <h1 class="text-3xl font-bold mb-6">MerchCalc Pro</h1>
                <p class="text-xl mb-8">Optimisez la rentabilité de vos points de vente</p>
                <ul class="space-y-3">
                    <li class="flex items-center">
                        <i class="fas fa-chart-line mr-3"></i>
                        <span>Analyses démographiques</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-store mr-3"></i>
                        <span>Gestion des points de vente</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-calculator mr-3"></i>
                        <span>Calculs de rentabilité</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chart-pie mr-3"></i>
                        <span>Tableaux de bord dynamiques</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Right side login form -->
        <div class="w-full md:w-1/2 p-8 md:p-12">
            <div class="mb-8 text-center md:text-left">
                <h2 class="text-2xl font-bold text-gray-800 mb-1">Bienvenue</h2>
                <p class="text-gray-600">Connectez-vous à votre compte</p>
            </div>

            <form id="loginForm" class="space-y-6" action="/login" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="votre.email@exemple.com">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-500">Mot de passe oublié?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="••••••••">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" id="togglePassword"
                                class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Se souvenir de moi
                    </label>
                </div>

                <div>
                    <button type="submit" id="loginButton"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center">
                        <span>Connexion</span>
                        <i id="spinnerIcon" class="ml-2 fas fa-spinner fa-spin hidden"></i>
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                Vous n'avez pas de compte?
                <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                    Contactez votre administrateur
                </a>
            </div>
        </div>
    </div>

    <!-- error modal -->
    <?php if (isset($_SESSION['error'])): ?>
        <?php
        $isSuccess = $_SESSION['error']['type'] === 'success';
        $bgColor = $isSuccess ? 'bg-emerald-50' : 'bg-rose-50';
        $textColor = $isSuccess ? 'text-emerald-800' : 'text-rose-800';
        $borderColor = $isSuccess ? 'border-emerald-200' : 'border-rose-200';
        $iconBgColor = $isSuccess ? 'bg-emerald-100' : 'bg-rose-100';
        ?>
        <div id="alert-message" class="message fixed top-4 left-1/2 transform -translate-x-1/2 z-50 animate-fadeIn
                flex items-center gap-3 w-auto max-w-md
                <?php echo "$bgColor $textColor $borderColor"; ?> 
                px-4 py-3 rounded-lg shadow-lg border">

            <!-- Icon container with circular background -->
            <div class="<?php echo $iconBgColor; ?> p-2 rounded-full flex-shrink-0">
                <?php if ($isSuccess): ?>
                    <!-- Success icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                <?php else: ?>
                    <!-- Error icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                <?php endif; ?>
            </div>

            <!-- Message content -->
            <div class="flex-1">
                <p class="font-medium"><?php echo htmlspecialchars($_SESSION['error']['message']); ?></p>
            </div>

            <!-- Close button -->
            <button onclick="this.parentElement.remove()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <script>

        // Hide the message after 5 seconds
        setTimeout(() => {
            const alertMessage = document.getElementById('alert-message');
            if (alertMessage) {
                alertMessage.classList.add('opacity-0');
                setTimeout(() => alertMessage.remove(), 300);
            }
        }, 5000);

        document.addEventListener('DOMContentLoaded', function () {
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');
            const spinnerIcon = document.getElementById('spinnerIcon');
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const alertBox = document.getElementById('alertBox');
            const alertIcon = document.getElementById('alertIcon');
            const alertMessage = document.getElementById('alertMessage');

            // Toggle password visibility
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                togglePassword.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });

            // Show alert function
            function showAlert(message, type) {
                // Set color and icon based on type
                if (type === 'success') {
                    alertBox.className = 'fixed top-4 right-4 max-w-xs p-4 bg-green-50 text-green-800 rounded-lg shadow-lg flex items-center';
                    alertIcon.innerHTML = '<i class="fas fa-check-circle text-green-500 text-xl"></i>';
                } else {
                    alertBox.className = 'fixed top-4 right-4 max-w-xs p-4 bg-red-50 text-red-800 rounded-lg shadow-lg flex items-center';
                    alertIcon.innerHTML = '<i class="fas fa-exclamation-circle text-red-500 text-xl"></i>';
                }

                alertMessage.textContent = message;

                // Show the alert with animation
                setTimeout(() => {
                    alertBox.style.transform = 'scale(1)';
                }, 10);

                // Hide after 4 seconds
                setTimeout(() => {
                    alertBox.style.transform = 'scale(0)';
                }, 4000);
            }

            // Form submission
            loginForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Get form data
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                // Show spinner
                loginButton.disabled = true;
                spinnerIcon.classList.remove('hidden');
                loginForm.submit();
            });
        });
    </script>
</body>

</html>