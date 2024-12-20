@extends('layouts.app ')

@section('title', 'The list of tasks')

@section('content')
    <nav class="mb-4">
        <a class="font-medium text-gray-700 underline decoration-pink-500" href="{{ route('tasks.create') }}">Add Task</a>
    </nav>
    <div>
        @forelse ($tasks as $task)
            <div>
                <a @class(['font-bold','line-through' => $task->completed]) href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
            </div>
        @empty
            <div>There are no tasks!</div>
        @endforelse
    </div>
    @if ($tasks->count())
      <nav class="mt-4">
        {{ $tasks->links() }}
      </nav>
    @endif
@endsection
