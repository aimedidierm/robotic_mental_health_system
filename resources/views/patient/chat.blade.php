@extends('layout')

@section('content')
<x-patient-navbar />
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="sm:ml-64">
    <div class="pt-16 container mx-auto">
        <div class="min-w-full lg:grid dark:bg-gray-800">
            <div class="border-r border-gray-300 lg:col-span-1 dark:border-gray-700">
                <div class="hidden lg:col-span-2 lg:block dark:border-gray-700">
                    <div class="w-full">
                        <div class="relative flex items-center p-3 border-b border-gray-300">
                            <img class="object-cover w-10 h-10 rounded-full" src="/user.png" alt="RMHS Bot" />
                            <span class="block ml-2 font-bold text-gray-600">RMHS Bot</span>
                            <span class="absolute w-3 h-3 bg-green-600 rounded-full left-10 top-3">
                            </span>
                        </div>
                        <div class="relative w-full p-6 overflow-y-auto h-[30rem]">
                            <div class="min-w-full h-screen lg:grid dark:bg-gray-800">
                                <div class="min-w-full h-screen lg:grid dark:bg-gray-800">
                                    <ul class="space-y-2 chat-container">
                                        <li class="flex justify-start">
                                            <div
                                                class="relative max-w-xl px-4 py-2 text-white dark:bg-blue-400 bg-blue-600 dark:text-white rounded shadow">
                                                <span class="block">Hello can I know the kind of service do you need
                                                    between: <br>
                                                    @foreach ($services as $service)
                                                    {{$service->id}}{{'. '}}{{$service->title}} <br>
                                                    @endforeach
                                                    You can replay with the number of your choice, thank you.</span>
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
                    <div class="relative max-w-xl px-4 py-2 text-gray-700 bg-gray-100 rounded shadow">
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
                    <div class="relative max-w-xl px-4 py-2 text-white dark:bg-blue-400 bg-blue-600 dark:text-white rounded shadow">
                        <span class="block">Great! Please provide a short description about the service you need.</span>
                    </div>
                `;
                step++;
            } else {
                botResponse = `
                    <div class="relative max-w-xl px-4 py-2 text-white dark:bg-blue-400 bg-blue-600 dark:text-white rounded shadow">
                        <span class="block">Invalid input. Please enter a valid service number.</span>
                    </div>
                `;
            }
            break;

        case 2:
            sessionStorage.setItem('shortDescription', userMessage);

            botResponse = `
                <div class="relative max-w-xl px-4 py-2 text-white dark:bg-blue-400 bg-blue-600 dark:text-white rounded shadow">
                    <span class="block">Thank you! Could you please let us know your availability date? (YYYY-MM-DD)</span>
                </div>
            `;
            step++;
            break;

            case 3:
    const availabilityTime = userMessage.trim();

    if (isValidDate(availabilityTime)) {
        sessionStorage.setItem('availabilityTime', availabilityTime);

        const serviceChoice = sessionStorage.getItem('serviceChoice');
        const shortDescription = sessionStorage.getItem('shortDescription');

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const postData = {
            serviceChoice,
            shortDescription,
            availabilityTime
        };

        console.log(postData);

        fetch('http://localhost:8000/patient/chat', {
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
            <div class="relative max-w-xl px-4 py-2 text-white dark:bg-blue-400 bg-blue-600 dark:text-white rounded shadow">
                
<span class="block">Thank you for providing the information. We will contact you shortly. and you can find your schedule
    <a href="/patient/schedules"><b class="text-red-700">Here</b></a></span>
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
    function isValidDate(dateString) {
    const regex = /^\d{4}-\d{2}-\d{2}$/;
    if (!regex.test(dateString)) {
        return false;
    }

    const parts = dateString.split('-');
    const year = parseInt(parts[0], 10);
    const month = parseInt(parts[1], 10);
    const day = parseInt(parts[2], 10);

    return year >= 1000 && year <= 9999 && month >= 1 && month <= 12 && day >= 1 && day <= 31;
}

    receivedMessageContainer.innerHTML = botResponse;
    chatContainer.appendChild(receivedMessageContainer);
}
    </script>
    @stop