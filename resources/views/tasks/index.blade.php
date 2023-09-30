<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <h1 class="text-2xl font-bold">Tasks</h1>
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <input type="text" name="text" class="border border-gray-300 rounded-md px-2 py-1" placeholder="Add a new task">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Task</button>
                        </form>
                    </div>
                    <div class="mt-4">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Title</th>
                                    <th class="px-4 py-2">Description</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="border px-4 py-2">                                            
                                            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <!-- If checkbox changed then send is_done 1 or 0 -->
                                                <input type="hidden" name="is_done" value="{{ $task->is_done ? 0 : 1 }}">
                                                <input type="checkbox" name="is_done" value="{{ $task->is_done ? 0 : 1 }}" {{ $task->is_done ? 'checked' : '' }} onchange="this.form.submit()">
                                                <!-- Inline p tag for task text -->
                                                <p class="inline {{ $task->is_done ? 'line-through' : '' }}">{{ $task->text }}</p>
                                            </form>
                                                
                                            </form></td>
                                        <td class="border px-4 py-2">{{ $task->description }}</td>
                                        <td class="border px-4 py-2">
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>