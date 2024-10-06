<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Edit ToDo |' }}</x-slot>

    <div class="container">
        <h1>Edit Todo</h1>
        <form action="{{ url('admin-panel/dashboard/to-dos', $to_do->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{ $to_do->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description">{{ $to_do->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                    <option value="pending" {{ $to_do->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $to_do->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</x-app-layout>
