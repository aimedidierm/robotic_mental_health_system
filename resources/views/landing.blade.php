<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body>
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">
                <div class="text-white text-2xl font-bold">Robotic mental health system</div>
                <ul class="flex space-x-4">
                    <li><a href="/" class="text-white">Home</a></li>
                    <li><a href="/#about" class="text-white">About Us</a></li>
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
    <section id="about" class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">About Us</h2>
            <p class="text-gray-700 text-lg">
                Welcome to {{env('APP_NAME')}} – Your Path to Mental Wellness.

                At {{env('APP_NAME')}}, we understand that taking care of your mental health is paramount.
                We're here to make the journey to mental wellness as accessible and seamless as possible.

                Our mission is simple: to connect you with experienced and compassionate mental health professionals who
                can provide the support you need. Whether you're navigating stress, anxiety, depression, or seeking
                personal growth and self-discovery, we're here to help you find the right expert who can guide you on
                your path to well-being.
            </p>
        </div>
    </section>
</body>

</html>