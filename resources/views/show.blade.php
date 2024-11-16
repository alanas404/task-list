@extends('layouts.app ')

@section('title', $task->title)
@section('content')
    <div>
        <a class="font-medium text-gray-700 underline decoration-pink-500" href="{{ route('tasks.index') }}">Go back the task list!</a>
    </div>
    <div>
        <p class="mb-4 text-slate-700">{{ $task->description }}</p>
        @if ($task->long_description)
            <p>{{ $task->long_description }}</p>
        @endif

        @if($task->completed)
        Completed
        @else
        Not Completed
        @endif
    </div>
    <div>
        <a href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a>
    </div>

    <div>
        <form action="{{route('tasks.toggle-complete',['task'=>$task])}}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit">Mark as {{ $task->completed ? 'completed' : 'not completed' }}</button>
        </form>
    </div>
    <div>
        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endsection
