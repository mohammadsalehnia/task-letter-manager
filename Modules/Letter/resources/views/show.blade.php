<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Letter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="title">Title</label>
                    <input disabled type="text" name="title" id="title" value="{{ $letter->id }}">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="body">Body</label>
                    <input disabled type="text" name="body" id="body" value="{{ $letter->id }}">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="user">User</label>
                    <input disabled type="text" name="user" id="user" value="{{ $letter->user->name }}">
                </div>
            </div>


            <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="tasks">tasks</label>
                    <select disabled name="tasks[]" class="form-select" aria-label="tasks" multiple>
                        @foreach($letter->tasks as $task)
                            <option selected value="{{ $task->id }}">{{ $task->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

