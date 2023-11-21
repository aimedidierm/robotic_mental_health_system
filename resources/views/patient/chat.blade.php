@extends('layout')

@section('content')
<style>
    body {
        font-family: 'Arial', sans-serif;
    }

    .scrolling-text {
        white-space: nowrap;
        overflow: hidden;
    }

    .scrolling-text p {
        animation: scrollText 10s linear infinite;
        transform-origin: left;
        animation-play-state: running;
        width: 100%;
    }

    @keyframes scrollText {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    /* Additional styles for the chat interface */
    .chat-container {
        list-style-type: none;
        margin: 0;
        padding: 0;


        background-image: url('wallpaper.jpg');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        padding: 10px;
        Add any other styles you want for the scrolling-text div
    }

    .message-container {
        max-width: 80%;
        margin-bottom: 1rem;
        overflow-wrap: break-word;
    }

    .user-message {
        text-align: right;
    }

    .bot-message {
        text-align: left;
    }

    #message-input {
        width: calc(100% - 48px);
        padding: 10px;
        margin: 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        outline: none;
    }

    #send-button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    #send-button:hover {
        background-color: #45a049;
    }
</style>
<x-patient-navbar />
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="sm:ml-64">
    <div class="pt-16 container mx-auto">
        <div class="min-w-full lg:grid dark:bg-gray-800">
            <div class="border-r border-gray-300 lg:col-span-1 dark:border-gray-700">
                <div class="hidden lg:col-span-2 lg:block dark:border-gray-700">
                    <div class="w-full">
                        <div class="w-full">
                            <div class="relative flex items-center p-3 border-b border-gray-300">
                                <div>
                                    <img class="object-cover w-10 h-10 rounded-full" src="/user.png" alt="RMHS Bot" />
                                    <span class="absolute w-3 h-3 bg-green-600 rounded-full left-10 top-3"></span>
                                </div>
                                <span class="block ml-2 font-bold text-gray-600">RMHS Bot</span>
                                <div class="px-80 scrolling-text">
                                    <div class="justify-end w-96">
                                        <p>
                                            I choose to let go of negative thoughts and embrace positivity,
                                            I am worthy of love, respect, and compassion,
                                            My mental health is a priority, and I choose to take care of myself,
                                            I am capable of handling any challenge that comes my way,

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative w-full p-6 overflow-y-auto h-[30rem]">
                            <div class="min-w-full h-screen lg:grid dark:bg-gray-800">
                                <div class="min-w-full h-screen lg:grid dark:bg-gray-800">
                                    <ul class="space-y-2 chat-container">
                                        <li class="flex justify-start">
                                            <div
                                                class="ml-2 py-3 px-4 dark:bg-blue-400 bg-blue-600 rounded-br-3xl rounded-tr-3xl rounded-tl-3xl text-white">
                                                <span class="block">
                                                    <div class="flex items-center">
                                                        <div>
                                                            Hello! Can I know the kind of service you need between: <br>
                                                            @foreach ($services as $service)
                                                            {{$service->id}}{{'. '}}{{$service->title}} <br>
                                                            @endforeach
                                                            You can reply with the number of your choice. Thank you.
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>


                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between w-full p-3 border-t border-gray-300">
                            <input id="message-input" type="text" placeholder="Enter your message..."
                                class="block w-full py-2 pl-4 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700"
                                required />
                            <button id="send-button">
                                <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const chatContainer = document.querySelector('.chat-container');
        const messageInput = document.getElementById('message-input');
        const sendButton = document.getElementById('send-button');
    
        let step = 1;
    
        messageInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                sendButton.click();
            }
        });
    
        sendButton.addEventListener('click', () => {
            const message = messageInput.value.trim();
    
            if (message !== '') {
                const sentMessageContainer = document.createElement('li');
                sentMessageContainer.className = 'flex justify-end';
                sentMessageContainer.innerHTML = `
                    <div class="mr-2 py-3 px-4 bg-yellow-700 bg-gray-100 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                        <span class="block">${message}</span>
                    </div>
                `;
    
                chatContainer.appendChild(sentMessageContainer);
    
                messageInput.value = '';
    
                setTimeout(() => {
                    handleBotResponse(message);
                }, 1000);
            }
        });
    const totalServices = {!! json_encode($totalServices) !!};
    function isValidServiceChoice(input) {
        const choice = parseInt(input);
        return !isNaN(choice) && choice >= 1 && choice <= totalServices;
    }

    function handleBotResponse(userMessage) {
    const receivedMessageContainer = document.createElement('li');
    receivedMessageContainer.className = 'flex justify-start';
    let botResponse = '';

    switch (step) {
        case 1:
            if (isValidServiceChoice(userMessage)) {
                sessionStorage.setItem('serviceChoice', userMessage);

                botResponse = `
                    <div class="ml-2 py-3 px-4 dark:bg-blue-400 bg-blue-600 rounded-br-3xl rounded-tr-3xl rounded-tl-3xl text-white">
                        <span class="block">Great! Please provide a short description about the service you need.</span>
                    </div>
                `;
                step++;
            } else {
                botResponse = `
                    <div class="ml-2 py-3 px-4 dark:bg-blue-400 bg-blue-600 rounded-br-3xl rounded-tr-3xl rounded-tl-3xl text-white">
                        <span class="block">Invalid input. Please enter a valid service number.</span>
                    </div>
                `;
            }
            break;

        case 2:
            sessionStorage.setItem('shortDescription', userMessage);

            botResponse = `
                <div class="ml-2 py-3 px-4 dark:bg-blue-400 bg-blue-600 rounded-br-3xl rounded-tr-3xl rounded-tl-3xl text-white">
                    <span class="block">You can select a doctor from the following:<br>
                    @foreach ($doctors as $doctor)
                    {{$doctor->id}}{{'. '}}{{$doctor->name}} <br>
                    @endforeach
                    You can replay with the number of your choice.
                    </span>
                </div>
            `;
            step++;
            break;

            case 3:
    const availlableDoctor = userMessage.trim();

    if (availlableDoctor) {
        sessionStorage.setItem('availlableDoctor', availlableDoctor);

        const serviceChoice = sessionStorage.getItem('serviceChoice');
        const shortDescription = sessionStorage.getItem('shortDescription');

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const postData = {
            serviceChoice,
            shortDescription,
            availlableDoctor
        };

        console.log(postData);

        fetch('https://didier.requestcatcher.com/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(postData)
        })
        .then(response => response.json())
        .then(data => {
        })
        .catch(error => {
            console.error('Error:', error);
        });

        botResponse = `
            <div class="ml-2 py-3 px-4 dark:bg-blue-400 bg-blue-600 rounded-br-3xl rounded-tr-3xl rounded-tl-3xl text-white">
                
<span class="block">Thank you for providing the information. We will contact you shortly. and you can find your schedule for payment
    <a href="/patient/payments"><b class="text-red-700">Here</b></a></span>
            </div>`;
        step++;
    } else {
        botResponse = `
            <div class="relative max-w-xl px-4 py-2 text-white dark:bg-blue-400 bg-blue-600 dark:text-white rounded shadow">
                <span class="block">Invalid date format. Please enter a valid date (YYYY-MM-DD).</span>
            </div>`;
    }
    break;
    }

    receivedMessageContainer.innerHTML = botResponse;
    chatContainer.appendChild(receivedMessageContainer);
}
    </script>
    @stop