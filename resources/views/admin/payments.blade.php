@extends('layout')

@section('content')

<x-admin-navbar />
<div class="sm:ml-64">
    <div class="px-4 py-28 relative overflow-x-auto">
        <div class="flex justify-between pb-4">
            <h2 class="text-xl text-grey-800 dark:text-white font-semibold mb-4">All payments</h2>
            <a href="/admin/report"
                class="text-white justify-end bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Get report
            </a>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 neumorphic">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Patient
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Amount
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($payments->isEmpty())
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" colspan="4"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        No payments found
                    </th>
                </tr>
                @else
                @foreach ($payments as $payment)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$payment->user->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{$payment->amount}} Rwf
                    </td>
                    <td class="px-6 py-4">
                        {{$payment->status}}
                    </td>
                    <td class="px-6 py-4">
                        {{$payment->user->phone}}
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
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