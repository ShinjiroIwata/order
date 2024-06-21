<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品編集 </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/2">
                <form action="{{ route('admin.product.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="p-6 text-gray-900">
                        <div class="relative mb-4">
                            <label for="product_name" class="leading-7 text-sm text-gray-600">商品名</label>
                            <input type="text" id="product_name" name="product_name"
                                value="{{ old('product_name', $product->name) }}"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        @if ($errors->has('product_name'))
                            <span class="text-danger">{{ $errors->first('product_name') }}</span>
                        @endif
                        <div class="relative mb-4">
                            <label for="product_price" class="leading-7 text-sm text-gray-600">価格</label>
                            <input type="text" id="product_price" name="product_price"
                                value="{{ old('product_price', $product->price) }}"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        @if ($errors->has('product_price'))
                            <span class="text-danger">{{ $errors->first('product_price') }}</span>
                        @endif
                        <div class="relative mb-4">
                            <label class="leading-7 text-sm text-gray-600">現在の商品画像</label>
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt=""
                                class="sec-03__img">
                        </div>
                        <div class="relative mb-4">
                            <label for="product_img" class="leading-7 text-sm text-gray-600">商品画像</label>
                            <input type="file" id="product_img" name="product_img"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>

                        @if ($errors->has('product_img'))
                            <span class="text-danger">{{ $errors->first('product_img') }}</span>
                        @endif
                        <button
                            class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
                    </div>
                </form>

            </div>
        </div>
</x-app-layout>
