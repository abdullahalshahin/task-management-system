<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Task Show |' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard/tasks') }}"> Tasks </a></li>
                            <li class="breadcrumb-item active">Show</li>
                        </ol>
                    </div>

                    <h4 class="page-title">Task Show</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <p class="text-muted mb-2 font-13"><strong>title :</strong> <span class="ms-2"> {{ $task->title ?? "" }} </span></p>
                            <p class="text-muted mb-2 font-13"><strong>Deadline :</strong> <span class="ms-2"> {{ $task->deadline ?? "" }} </span></p>
                            <p class="text-muted mb-2 font-13"><strong>Priority :</strong> <span class="ms-2"> {{ $task->priority ?? "" }} </span></p>
                            <p class="text-muted mb-2 font-13"><strong>Status :</strong>
                                <span class="ms-2"> 
                                    @if ($task->status == "complete")
                                        <span class="badge badge-success-lighten"> Complete </span>
                                    @elseif ($task->status == "incomplete")
                                        <span class="badge badge-danger-lighten"> Incomplete </span>
                                    @endif
                                </span>
                            </p>
                            <p class="text-muted mb-2 font-13"><strong>Description :</strong> <span class="ms-2"> {{ $task->description ?? "" }} </span></p>
                        </div>

                        <div class="float-end">
                            <a href="{{ url('admin-panel/dashboard/tasks') }}" class="btn btn-primary button-last"> Go Back </a>
                            <a href="{{ url('admin-panel/dashboard/tasks/'. $task->id .'/edit') }}" class="btn btn-success button-last"> Edit </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
