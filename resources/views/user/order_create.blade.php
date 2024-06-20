<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            発注 </h2>
    </x-slot>

    <style>
        .sec-01__inner {
            width: 1000px;
            max-width: 100%;
        }

        .sec-01__block:not(:last-child) {
            margin-bottom: 16px;
        }

        .sec-01__block {
            display: flex;
            height: 200px;
            background-color: #fff;
            padding: 24px;

        }

        .sec-01__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .sec-01__item-01 {
            flex: 1;
        }

        .sec-01__item-02 {
            flex: 2;
            display: flex;
            align-items: center;
            padding: 24px;
            gap: 24px;
            justify-content: space-between
        }

        .sec-01__item-03 {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 24px;
        }

        .sec-01__btn-area {
            text-align: right;
        }

        .sec-01__item-body-ttl {
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sec-01__inner">
                <form action="{{ route('user.order_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="relative mb-4">
                        <label for="product_name" class=" leading-7 text-sm text-gray-600">日付</label>
                        <input type="date" id="product_name" name="order_date" required
                            class=" datepicker bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    @foreach ($products as $product)
                        <div class="sec-01__block">
                            <div class="sec-01__item sec-01__item-01">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt=""
                                    class="sec-01__img">
                            </div>
                            <div class="sec-01__item sec-01__item-02">
                                <div class="sec-01__item-body-ttl">
                                    {{ $product->name }}
                                </div>
                                <div class="sec-01__item-body-cost">
                                    {{ $product->price }}円
                                </div>
                            </div>
                            <div class="sec-01__item sec-01__item-03">
                                <select name="order_num[{{ $product->id }}]" id="">
                                    <option value="0">発注しない</option>
                                    @for ($i = 1; $i < 100; $i++)
                                        <option value="{{ $i * 10 }}">{{ $i * 10 }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    @endforeach
                    <div class="sec-01__btn-area">
                        <button
                            class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">発注</button>
                    </div>

                </form>

            </div>
        </div>
</x-app-layout>
