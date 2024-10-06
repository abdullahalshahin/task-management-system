<div class="row g-2">
    <div class="mb-2 col-md-12">
        <label for="title"> Title <span class="text-danger">*</span> </label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title ?? "") }}" placeholder="" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-2 col-md-12">
        <label for="description"> Description </label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $task->description ?? "") }}</textarea>
    </div>

    @error('description')
        <div class="alert alert-danger mb-2">{{ $message }}</div>
    @enderror
</div>

<div class="row g-2">
    <div class="mb-2 col-md-4">
        <label for="deadline"> Deadline <span class="text-danger">*</span> </label>
        <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline', $task->deadline ?? "") }}" placeholder="" required>
    </div>

    <div class="mb-2 col-md-4">
        <label for="priority"> Priority </label>
        <input type="number" min="0" class="form-control" id="priority" name="priority" value="{{ old('priority', $task->priority ?? "") }}" placeholder="">
    </div>

    <div class="mb-2 col-md-4">
        <label for="input_status"> Status <span class="text-danger">*</span> </label>
        <select class="form-select" id="input_status" name="input_status" required>
            <option value="incomplete" {{ (old('input_status') ?? ($task->status ?? "")) == "incomplete" ? 'selected' : "" }}> Incomplete </option>
            <option value="complete" {{ (old('input_status') ?? ($task->status ?? "")) == "complete" ? 'selected' : "" }}> Complete </option>
        </select>
    </div>
</div>
