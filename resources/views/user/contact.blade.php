<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お問い合わせ </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/2">
                <form action="{{ route('user.contact_store') }}" method="POST" id="contactForm">
                    @csrf
                    <div class="p-6 text-gray-900">
                        <div class="relative mb-4">
                            <label for="message" class="leading-7 text-sm text-gray-600">お問い合わせ内容</label>
                            <textarea type="text" id="message" name="message"
                                class="sec-01__txt-area w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>

                            @if ($errors->has('message'))
                                <span class="text-danger">{{ $errors->first('message') }}</span>
                            @endif
                        </div>

                        <button onclick="confirmSubmission()"
                            class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">送信</button>
                    </div>
                </form>

            </div>
        </div>

        <script>
            function confirmSubmission() {
                if (confirm('送信してよろしいですか？')) {
                    document.getElementById('contactForm').submit();
                }
            }
        </script>
</x-app-layout>
