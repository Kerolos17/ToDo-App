@extends('layouts.app')
@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Task</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-md mx-auto">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-2">Task Title</label>
            <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ $task->title }}" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Update Task</button>
    </form>
@endsection
