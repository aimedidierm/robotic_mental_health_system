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
                <div class="text-white text-2xl font-bold">{{env('APP_NAME')}}</div>
                <ul class="flex space-x-4">
                    <li><a href="/" class="text-white">Home</a></li>
                    <li><a href="/login" class="text-white">Login</a></li>
                    <li><a href="/sign-up" class="text-white">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto ">
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 glassmorphism">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                        {{env('APP_NAME')}}
                    </a>
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1
                            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Register your account
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="/sign-up" method="POST">
                            @if($errors->any())<span
                                class="self-center text-1xl font-semibold whitespace-nowrap text-red-600 dark:text-red-600">{{$errors->first()}}</span>@endif
                            @csrf
                            <div class="flex space-x-4">
                                <div class="w-1/2">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                        names</label>
                                    <input type="text" name="name" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Enter your names" required="">
                                </div>
                                <div class="w-1/2">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                        email</label>
                                    <input type="email" name="email" id="email"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="name@example.com" required="">
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <div class="w-1/2">
                                    <label for="province"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Province</label>
                                    <select name="province" id="province"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach ($address as $province)
                                        <option value="{{$province->name}}">{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-1/2">
                                    <label for="district"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        District</label>
                                    <select name="district" id="district"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="district name"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <div class="w-1/2">
                                    <label for="sector"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Sector</label>
                                    <select name="sector" id="sector"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="sector name"></option>
                                    </select>
                                </div>
                                <div class="w-1/2">
                                    <label for="cell"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Cell</label>
                                    <select name="cell" id="cell"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="village name"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <div class="w-1/2">
                                    <label for="village"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Village</label>
                                    <select name="village" id="village"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="village name"></option>
                                    </select>
                                </div>
                                <div class="w-1/2">
                                    <label for="sponsor"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                        sponsor</label>
                                    <input type="text" name="sponsor" id="sponsor"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Enter your sponsor person" required="">
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <div class="w-1/2">
                                    <label for="age"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                        date of birth</label>
                                    <input type="date" name="age" id="age"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Enter your date of birth" required="">
                                </div>
                                <div class="w-1/2">
                                    <label for="status"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                        your
                                        status</label>
                                    <select name="status" id="status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="divorced">Divorced</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                    phone</label>
                                <input type="phone" name="phone" id="phone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="0788888888" required="">
                            </div>
                            <div class="flex space-x-4">
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input type="password" name="password" id="password" placeholder="••••••••"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required="">
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                        password</label>
                                    <input type="password" name="confirmPassword" id="password" placeholder="••••••••"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required="">
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register
                            </button>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                you have an account yet? <a href="/login"
                                    class="font-medium text-blue-600 hover:underline dark:text-blue-500">Login</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const provinces = @json($address);
        const districtDropdown = document.getElementById('district');
        const sectorDropdown = document.getElementById('sector');
        const cellDropdown = document.getElementById('cell');
        const villageDropdown = document.getElementById('village');

        const updateDistricts = () => {
            const selectedProvince = document.getElementById('province').value;
            const selectedProvinceObj = provinces.find(province => province.name === selectedProvince);

            districtDropdown.innerHTML = '<option value="">Select District</option>';
            sectorDropdown.innerHTML = '<option value="">Select Sector</option>';
            cellDropdown.innerHTML = '<option value="">Select Cell</option>';
            villageDropdown.innerHTML = '<option value="">Select Village</option>';

            if (selectedProvinceObj) {
                selectedProvinceObj.districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.name;
                    option.textContent = district.name;
                    districtDropdown.appendChild(option);
                });
            }
        };

        const updateSectors = () => {
            const selectedDistrict = document.getElementById('district').value;
            const selectedProvince = document.getElementById('province').value;
            const selectedProvinceObj = provinces.find(province => province.name === selectedProvince);

            sectorDropdown.innerHTML = '<option value="">Select Sector</option>';
            cellDropdown.innerHTML = '<option value="">Select Cell</option>';
            villageDropdown.innerHTML = '<option value="">Select Village</option>';

            if (selectedProvinceObj) {
                const selectedDistrictObj = selectedProvinceObj.districts.find(district => district.name === selectedDistrict);

                if (selectedDistrictObj) {
                    selectedDistrictObj.sectors.forEach(sector => {
                        const option = document.createElement('option');
                        option.value = sector.name;
                        option.textContent = sector.name;
                        sectorDropdown.appendChild(option);
                    });
                }
            }
        };

        const updateCells = () => {
            const selectedSector = document.getElementById('sector').value;
            const selectedDistrict = document.getElementById('district').value;
            const selectedProvince = document.getElementById('province').value;
            const selectedProvinceObj = provinces.find(province => province.name === selectedProvince);

            cellDropdown.innerHTML = '<option value="">Select Cell</option>';
            villageDropdown.innerHTML = '<option value="">Select Village</option>';

            if (selectedProvinceObj) {
                const selectedDistrictObj = selectedProvinceObj.districts.find(district => district.name === selectedDistrict);

                if (selectedDistrictObj) {
                    const selectedSectorObj = selectedDistrictObj.sectors.find(sector => sector.name === selectedSector);

                    if (selectedSectorObj) {
                        selectedSectorObj.cells.forEach(cell => {
                            const option = document.createElement('option');
                            option.value = cell.name;
                            option.textContent = cell.name;
                            cellDropdown.appendChild(option);
                        });
                    }
                }
            }
        };

        const updateVillages = () => {
            const selectedCell = document.getElementById('cell').value;
            const selectedSector = document.getElementById('sector').value;
            const selectedDistrict = document.getElementById('district').value;
            const selectedProvince = document.getElementById('province').value;
            const selectedProvinceObj = provinces.find(province => province.name === selectedProvince);

            villageDropdown.innerHTML = '<option value="">Select Village</option>';

            if (selectedProvinceObj) {
                const selectedDistrictObj = selectedProvinceObj.districts.find(district => district.name === selectedDistrict);

                if (selectedDistrictObj) {
                    const selectedSectorObj = selectedDistrictObj.sectors.find(sector => sector.name === selectedSector);

                    if (selectedSectorObj) {
                        const selectedCellObj = selectedSectorObj.cells.find(cell => cell.name === selectedCell);

                        if (selectedCellObj) {
                            selectedCellObj.villages.forEach(village => {
                                const option = document.createElement('option');
                                option.value = village.name;
                                option.textContent = village.name;
                                villageDropdown.appendChild(option);
                            });
                        }
                    }
                }
            }
        };

        document.getElementById('province').addEventListener('change', updateDistricts);
        document.getElementById('district').addEventListener('change', updateSectors);
        document.getElementById('sector').addEventListener('change', updateCells);
        document.getElementById('cell').addEventListener('change', updateVillages);
    });
</script>