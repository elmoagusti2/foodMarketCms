<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Foods &raquo; Create') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            There's something wrong
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                @endif
                <form action="{{ route('foods.store') }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name"
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</label>
                            <input type="text" placeholder="Name Products" id="grid-last-name" name="name"
                                class="appearance-none black w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-48 px-3">
                                <label for="grid-last-name"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Types</label>
                                <select name="types"
                                    class="appearance-none black  w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                                    <option value="MAKANAN">Makanan
                                    </option>
                                    <option value="MINUMAN">Minuman
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 ml-4">
                                <label for="grid-last-name"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Picture</label>
                                <input type="file" accept="image/png, image/jpeg" placeholder="Image"
                                    id="grid-last-name" name="picturePath"
                                    class="appearance-none black w-5/6 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name"
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Description</label>
                            <textarea placeholder="Description" id="grid-last-name" name="description"
                                class="appearance-none black w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500"></textarea>
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label for="grid-last-name"
                                    class="block w-3/6 uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 truncate md:text-clip">Price</label>
                                <input type="text" placeholder="Price" id="grid-last-name"
                                   name="price"
                                    class="w-5/6  bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6 mr-4">
                            <div class="w-full px-3">
                                <label for="grid-last-name"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Rating</label>
                                <input type="text" placeholder="rate" id="grid-last-name"
                                    name="rate"
                                    class="appearance-none black w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save Products
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
