<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10"><a href="{{ route('users.create') }}"
                    class="bg-red-700 hover:bg-red-500 text-white font-bold py-2 px-4 rounded">+ Create Users</a></div>
            <div class="bg-white overflow-auto">
                <table class="md:table-auto w-full">
                    <thead>
                        <tr>
                            <th class="border px-6 py-4">No</th>
                            <th class="border px-6 py-4">Name</th>
                            <th class="border px-6 py-4 ">Email</th>
                            <th class="border px-6 py-4">Roles</th>
                            <th class="border px-6 py-4">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $item => $value)
                            <tr>
                                <td class="border px-6 py-4">{{ $item + 1 }}</td>
                            <td class="border px-6 py-4">{{ $value->name }}</td>
                            <td class="border px-6 py-4 min-w-2 max-w-4">{{ $value->email }}</td>
                            <td class="border px-6 py-4">{{ $value->roles }}</td>
                            <td class="border px-6 py-4 text-center">
                                <a href="{{ route('users.edit', $value->id) }}"
                                    class="inline-block bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 mx-2 mb-2 rounded">Edit</a>
                                <form action="{{ route('users.destroy', $value->id) }}" method="POST"
                                    class="inline-block">
                                    {!! method_field('delete') . csrf_field() !!}
                                    <button type="submit"
                                        class="bg-red-700 hover:bg-red-500 text-white font-bold py-2 px-4 mx-2 rounded">Delete</button>
                                </form>
                            </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border text-center p-5">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-5">
                {{ $user->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
