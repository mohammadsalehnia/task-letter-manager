<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Letter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <form method="POST" action="{{ route('panel.letters.store') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
                    <div class="max-w-xl">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title">
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
                    <div class="max-w-xl">
                        <label for="body">Body</label>
                        <input type="text" name="body" id="body">
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
                    <div class="max-w-xl">
                        <label for="tasks">User</label>
                        <select name="user_id" class="form-select" aria-label="user_id">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
                    <div class="max-w-xl">
                        <label for="tasks">tasks</label>
                        <select name="tasks[]" class="form-select" aria-label="tasks" multiple>
                            @foreach($tasks as $task)
                                <option value="{{ $task->id }}">{{ $task->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
                    <button class="btn btn-block btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

