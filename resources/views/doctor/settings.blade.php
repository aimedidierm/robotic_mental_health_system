@extends('layout')

@section('content')
<x-doctor-navbar />
<div class="sm:ml-64">
    <div class="px-4 py-28 relative overflow-x-auto">
        <div class="bg-white dark:bg-gray-800 text-grey-600 dark:text-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl text-grey-800 dark:text-white font-semibold mb-4">Update User Details</h2>
            @if($errors->any())<span style="color: red;"> {{$errors->first()}}</span>@endif
            <form action="/doctor/settings" method="post">
                @csrf
                <div class="mb-4">
                    <label for="available"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <input type="datetime-local" id="available" name="available" value="{{Auth::user()->available}}"
                        class="mt-1 p-2 w-full border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-gray-600 dark:focus:border-gray-600">
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                    <input type="text" id="name" name="name" value="{{Auth::user()->name}}"
                        class="mt-1 p-2 w-full border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-gray-600 dark:focus:border-gray-600"
                        required>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                    <input type="number" id="phone" name="phone" value="{{Auth::user()->phone}}"
                        class="mt-1 p-2 w-full border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-gray-600 dark:focus:border-gray-600"
                        required>
                </div>

                <div class="mb-4">
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" id="password" name="password"
                        class="mt-1 p-2 w-full border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-gray-600 dark:focus:border-gray-600"
                        required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="mt-1 p-2 w-full border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-gray-600 dark:focus:border-gray-600"
                        required>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-blue-700 dark:hover:bg-blue-600 dark:focus:ring-gray-600">Update</button>
                </div>
            </form>
        </div>

    </div>
</div>
@stop