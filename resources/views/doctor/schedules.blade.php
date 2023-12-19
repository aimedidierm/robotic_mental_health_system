@extends('layout')

@section('content')
    <x-doctor-navbar />
    <div class="sm:ml-64">
        <div class="flex justify-between px-4 pt-28">
            <h2 class="text-xl text-grey-800 dark:text-white font-semibold mb-4">All schedules</h2>
            <button button type="button" data-modal-target="addNewModal" data-modal-toggle="addNewModal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Get report
            </button>
            @if ($errors->any())
                <span style="color: red;"> {{ $errors->first() }}</span>
            @endif
            <div id="addNewModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Select report details
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="addNewModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <div class="p-6 space-y-6">

                            <form action="/doctor/report" method="post">
                                @csrf
                                <div class="mb-6">
                                    <label for="year"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year:
                                    </label>
                                    <select name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select a year">
                                    @for ($year = date("Y"); $year >= (date("Y") - 10); $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                                </div>
                                <div class="mb-6">
                                    <label for="status"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mental status:
                                    </label>
                                    <select name="status" id="status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Enter names">
                                        @foreach($services as $service)
                                        <option value="{{$service->title}}">{{$service->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 py-4 relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 neumorphic">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Summary
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Patient
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sponsor
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date of birth
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($schedules->isEmpty())
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" colspan="9"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                No available schedule
                            </th>
                        </tr>
                    @else
                        @foreach ($schedules as $schedule)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $schedule->date)->format('Y-m-d') }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $schedule->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $schedule->comment }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $schedule->patient->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $schedule->patient->province }}, {{ $schedule->patient->province }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $schedule->patient->sponsor }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $schedule->patient->age }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $schedule->patient->m_status }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="/chat/{{ $schedule->patient->id }}"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Chat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="sm:ml-64">
            <style>
                .neumorphic {
                    background-color: #f0f2f5;
                    box-shadow: 4px 4px 8px 0px rgba(0, 0, 0, 0.2), -8px -8px 16px 0px rgba(255, 255, 255, 0.8);
                    padding: 10px;
                }

                .neumorphic:hover {
                    box-shadow: 12px 12px 20px 0px rgba(0, 0, 0, 0.2), -12px -12px 20px 0px rgba(255, 255, 255, 0.8);
                }
            </style>

        @stop
