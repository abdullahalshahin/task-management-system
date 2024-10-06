<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'ToDo |' }}</x-slot>

    <div class="container">
        <h1>To-Do List</h1>

        <a href="{{ route('to-dos.create') }}" class="btn btn-primary mb-3">Create New Todo</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->description }}</td>
                    <td>{{ $todo->status }}</td>
                    <td>
                        <a href="{{ route('to-dos.edit', $todo->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('to-dos.destroy', $todo->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
