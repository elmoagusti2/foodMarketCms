<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Users &raquo; Create') !!}
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
                <form action="{{ route('users.store') }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name"
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</label>
                            <input type="text" placeholder="Username" id="grid-last-name" value="{{ old('name') }}"
                                name="name"
                                class="appearance-none black w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name"
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Email</label>
                            <input type="text" placeholder="Email" id="grid-last-name" value="{{ old('email') }}"
                                name="email"
                                class="appearance-none black w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-48 px-3 mr-4">
                                <label for="grid-last-name"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Roles</label>
                                <select name="roles"
                                    class="appearance-none black  w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                                    <option value="USER">User</option>
                                    <option value="ADMIN">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label for="grid-last-name"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">User
                                    Image</label>
                                <input type="file" accept="image/png, image/jpeg" placeholder="Email" id="grid-last-name" name="profile_photo_path"
                                    class="appearance-none black w-5/6 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name"
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Password</label>
                            <input type="password" placeholder="Password" id="grid-last-name"
                                value="{{ old('password') }}" name="password"
                                class="appearance-none black w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name"
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Password
                                Confirmation</label>
                            <input type="password" placeholder="Password confirmation" id="grid-last-name"
                                value="{{ old('password_confirmation') }}" name="password_confirmation"
                                class="appearance-none black w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name"
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Address</label>
                            <input type="text" placeholder="Address" id="grid-last-name" value="{{ old('address') }}"
                                name="address"
                                class="appearance-none black w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label for="grid-last-name"
                                    class="block w-3/6 uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 truncate md:text-clip">House
                                    Number</label>
                                <input type="text" placeholder="House Number" id="grid-last-name"
                                    value="{{ old('houseNumber') }}" name="houseNumber"
                                    class="w-5/6  bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6 mr-4">
                            <div class="w-full px-3">
                                <label for="grid-last-name"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">City</label>
                                <input type="text" placeholder="City" id="grid-last-name" value="{{ old('city') }}"
                                    name="city"
                                    class="appearance-none black w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label for="grid-last-name"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Phone
                                    Number</label>
                                <input type="number" placeholder="Phone Number" id="grid-last-name"
                                    value="{{ old('phoneNumber') }}" name="phoneNumber"
                                    class="appearance-none black w-80 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:botder-gray-500">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save User
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
