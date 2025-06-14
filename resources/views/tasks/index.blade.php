@extends('layouts.app')
@section('title', 'Tasks')

@section('content')
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1 class="text-2xl font-bold mb-4">Task List</h1>

    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add New Task</a>

    <ul class="mt-6 space-y-4">
        @foreach ($tasks as $task)
            <li class="p-4 bg-white shadow rounded flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <form action="{{ route('tasks.update', $task) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="title" value="{{ $task->title }}">
                        <input type="hidden" name="is_done" value="0">
                        <input type="checkbox" name="is_done" value="1" onchange="this.form.submit()" class="h-5 w-5"
                            {{ $task->is_done ? 'checked' : '' }}>
                    </form>

                    <a href="{{ route('tasks.show', $task) }}"><span
                            class="{{ $task->is_done ? 'line-through text-gray-500' : '' }}">
                            {{ $task->title }}
                        </span></a>
                </div>

                <div class="space-x-2">
                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="text-red-500">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
