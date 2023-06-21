<x-app-layout>
    @section('title')
        Measurements
    @endsection
    <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Measurements') }}
                </h2>
                <form onsubmit="sumbitSearch()" action="{{ route('measurement.index') }}" class="flex justify-center w-full">
                    <input id="searchInput" value="{{ $query }}" placeholder="Search" class="border border-gray-300 p-2 rounded w-1/2" type="search">
                </form>
                <a href="{{ route('measurement.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                    {{__('Create')}}
                </a>
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 overflow-x-scroll md:overflow-x-hidden">
                    @if(session('success'))
                        <x-auth-session-status :type="'success'" :status="session('success')"></x-auth-session-status>
                    @elseif(session('error'))
                        <x-auth-session-status :type="'error'" :status="session('error')"></x-auth-session-status>
                    @endif
                    @if($measurements->count())
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-200 font-bold text-gray-600">
                                    <th class="p-3">{{__('No.')}}</th>
                                    <th class="p-3">{{__('Name')}}</th>
                                    <th class="p-3">{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($measurements as $measurement)
                                <tr>
                                    <td class="p-3">{{ $loop->iteration }}</td>
                                    <td class="p-3">{{ $measurement->name }}</td>
                                    <td class="p-3">
                                        <a href="{{ route('measurement.edit', $measurement->id) }}" class="text-green-500">{{ __('Edit') }}</a>
                                        -
                                        <form id="deleteForm" class="inline" action="{{ route('measurement.destroy', $measurement->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <span onclick="document.getElementById('deleteForm').submit()" class="text-red-500 cursor-pointer">
                                                {{ __('Delete') }}
                                            </span>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <br>
                        {{ $measurements->links() }}
                    @else
                        <p>{{ __('No item found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @section('script')
            <script src="{{ asset('js/search_script.js') }}"></script>
    @endsection
</x-app-layout>


