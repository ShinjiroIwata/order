<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            発注履歴 </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="">
                        <div class="relative mb-4">
                            <label for="order_date" class=" leading-7 text-sm text-gray-600">日付</label>
                            <div class="flex gap-4 items-center">
                                <input type="date" id="order_date" name="order_date"
                                    value="{{ request('order_date') }}"
                                    class=" datepicker bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <button
                                    class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">確認</button>
                            </div>

                        </div>
                    </form>
                    <table class="border-collapse border border-slate-400 w-full table-fixed">
                        @foreach ($orders as $order)
                            <tr>
                                <th class="px-4 py-4 border border-slate-300">
                                    {{ $order->product->name }}
                                </th>
                                <td class="px-4 py-4 border border-slate-300">
                                    {{ $order->num }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
