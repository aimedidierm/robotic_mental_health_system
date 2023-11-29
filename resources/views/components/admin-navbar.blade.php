<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <div class="flex md:order-2">

            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="flex justify-between md:order-2">
            <button type="button"
                class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="/profile.png" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-sm text-gray-900 dark:text-white">{{Auth::user()->name}}</span>
                    <span
                        class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{Auth::user()->email}}</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="/admin"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                        <a href="/admin/settings"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                    </li>
                    <li>
                        <a href="/logout"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                            out</a>
                    </li>
                </ul>
            </div>
            <button data-collapse-toggle="navbar-user" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-user" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
            aria-controls="default-sidebar" type="button"
            class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>

        <aside id="default-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
            aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto text-white bg-green-950 dark:bg-gray-800">
                <a href="/admin" class="flex items-center pl-2.5 mb-5">
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">RMHS -
                        Admin</span>
                </a>
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="/admin"
                            class="flex items-center p-2  rounded-lg dark:text-white hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="material-symbols-outlined">
                                groups
                            </span>
                            <span class="flex-1 ml-3 whitespace-nowrap">Admins</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/doctors"
                            class="flex items-center p-2  rounded-lg dark:text-white hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="material-symbols-outlined">
                                psychology
                            </span>
                            <span class="flex-1 ml-3 whitespace-nowrap">Doctors</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/payments"
                            class="flex items-center p-2  rounded-lg dark:text-white hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="material-symbols-outlined">
                                payments
                            </span>
                            <span class="flex-1 ml-3 whitespace-nowrap">Payments</span>
                        </a>
                    </li>
                    <li>
                        <button type="button" data-modal-target="printPatientsModel"
                            data-modal-toggle="printPatientsModel"
                            class="flex items-center p-2  rounded-lg dark:text-white hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="material-symbols-outlined">
                                group
                            </span>
                            <span class="flex-1 ml-3 whitespace-nowrap">Print patients</span>
                        </button>
                    </li>
                    <li>
                        <a href="/admin/settings"
                            class="flex items-center p-2  rounded-lg dark:text-white hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="material-symbols-outlined">
                                settings
                            </span>
                            <span class="flex-1 ml-3 whitespace-nowrap">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="/logout"
                            class="flex items-center p-2  rounded-lg dark:text-white hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="material-symbols-outlined">
                                logout
                            </span>
                            <span class="flex-1 ml-3 whitespace-nowrap">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</nav>
<div id="printPatientsModel" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Print based on selected district
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="printPatientsModel">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-6">

                <form action="/admin/patients" method="post">
                    @csrf
                    @php
                    $provinces = \App\Models\Province::get();
                    $provinces->load('districts');
                    @endphp

                    <div class="mb-6">
                        <label for="province"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province:</label>

                        <select id="province" name="province" onchange="populateDistricts()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="all">All</option>
                            @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="district"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">District:</label>
                        <select name="district" id="district"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </select>
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                    <script>
                        function populateDistricts() {
                            var provinceId = document.getElementById('province').value;
                            var districtSelect = document.getElementById('district');
                            
                            districtSelect.innerHTML = '';
                
                            var selectedProvince = {!! $provinces->toJson() !!}.find(province => province.id == provinceId);
                
                            selectedProvince.districts.forEach(district => {
                                var option = document.createElement('option');
                                option.value = district.name;
                                option.text = district.name;
                                districtSelect.add(option);
                            });
                        }
                    </script>
                </form>


            </div>
        </div>
    </div>
</div>