<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Robotic mental health system</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body>
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">
                <div class="text-white text-2xl font-bold">Robotic mental health system</div>
                <ul class="flex space-x-4">
                    <li><a href="/" class="text-white">Home</a></li>
                    <li><a href="/login" class="text-white">Login</a></li>
                    <li><a href="/sign-up" class="text-white">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mx-auto mt-8 px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Image Section -->
            <div>
                <img src="landing-robot.png" alt="Landing Image" class="w-full h-auto rounded-lg shadow-lg">
            </div>

            <!-- Text Section -->
            <div class="flex flex-col justify-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Your life is valuable</h1>
                <h1 class="text-4xl font-bold text-gray-800 mb-4">STAY ALIVE</h1>
                <p class="text-gray-600 text-lg mb-4">A mental health chatbot provides support and guidance through
                    conversations.</p>
                <a href="/login"
                    class="bg-blue-500 hover:bg-blue-600 text-white text-lg font-semibold py-2 px-4 rounded-full transition duration-300">
                    <center>START</center>
                </a>
            </div>
        </div>
    </div>
</body>

</html>