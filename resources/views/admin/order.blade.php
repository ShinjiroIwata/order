<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            発注データ </h2>
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
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 py-4 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                    ユーザー名</th>
                                @foreach ($products as $product)
                                    <th
                                        class="px-4 py-4 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        {{ $product->name }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupedOrders as $groupedOrder)
                                <tr>
                                    <td class="px-4 py-4">{{ $groupedOrder['user_name'] }}</td>
                                    @foreach ($products as $product)
                                        @foreach ($groupedOrder['orders'] as $order)
                                            @if ($product->id == $order->product_id)
                                                <td class="px-4 py-4">
                                                    {{ $order->num }}</td>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
