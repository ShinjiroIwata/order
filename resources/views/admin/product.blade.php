<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品一覧</h2>
    </x-slot>
    <style>
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="table-fixed w-full text-left whitespace-no-wrap sec-02__table">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 py-4 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                    商品画像</th>
                                <th
                                    class="px-4 py-4 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                    商品名</th>
                                <th
                                    class="px-4 py-4 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    価格</th>
                                <th
                                    class="px-4 py-4 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    編集</th>
                                <th
                                    class="px-4 py-4 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="px-4 py-4 w-40 product__img-td">
                                        <img class="product__img" src="{{ asset('storage/' . $product->image_path) }}"
                                            alt="{{ $product->name }}">
                                    </td>
                                    <td class="px-4 py-4">{{ $product->name }}</td>
                                    <td class="px-4 py-4">{{ $product->price }}</td>
                                    <td class="px-4 py-4">
                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                            class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集</a>
                                    </td>
                                    <td class="px-4 py-4">
                                        <form action="{{ route('admin.product.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button
                                                class="text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
