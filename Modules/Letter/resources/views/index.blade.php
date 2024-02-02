<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <a href="{{ route('panel.letter.create') }}" class="btn btn-info">Create Letter</a>

            @if (session('success'))
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                       
                    </div>
                </div>
            @endif

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>


                @foreach ($letters as $letter)
                    <tr>
                        <th scope="row">{{ $letter->id }}</th>
                        <td>{{ $letter->title }}</td>
                        <td>{{ $letter->body }}</td>
                        <td>

                            <a style="margin-bottom: 4px" class="btn btn-success" href="{{ route('panel.letter.show',$letter->id) }}">Show</a>
                            <form method="POST" action="{{ route('panel.letter.destroy',$letter->id) }}">
                                @csrf
                                @method('delete')
                                <a class="btn btn-danger" :href="route('panel.letter.destroy',$letter->id)"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Delete') }}
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            {{ $letters->links() }}
        </div>
    </div>
</x-app-layout>

