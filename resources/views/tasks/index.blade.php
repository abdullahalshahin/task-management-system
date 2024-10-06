<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Tasks |' }}</x-slot>

    <x-slot name="style">
        <link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tasks</li>
                        </ol>
                    </div>
                    
                    <h4 class="page-title">Task List</h4>
                </div>
            </div>
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success" id="notification_alert">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="{{ url('admin-panel/dashboard/tasks/create') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Task</a>
                            </div>

                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <button type="button" class="btn btn-light mb-2">Delete All</button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Deadline</th>
                                        <th></th>
                                        <th>Status</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($tasks as $key => $task)
                                        <tr >
                                            <td>{{ ++$key }}</td>
                                            <td class="
                                            {{ \Carbon\Carbon::parse($task->deadline)->isPast() && $task->status == 'incomplete' ? 'bg-danger' : 
                                            (\Carbon\Carbon::parse($task->deadline)->isFuture() && $task->status == 'incomplete' ? '' : 'bg-success') 
                                            }}">{{ $task->title ?? "" }}</td>
                                            <td> <span style="display: block; width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{ $task->description ?? "" }} </span></td>
                                            <td>{{ $task->deadline ?? "" }}</td>
                                            <td>
                                                @if ($task->status == "incomplete")
                                                    <a href="{{ url('admin-panel/dashboard/mark-as-completed', $task->id) }}" class="btn btn-info mb-2">Mark as Completed</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($task->status == "complete")
                                                    <span class="badge badge-success-lighten"> Complete </span>
                                                @elseif ($task->status == "incomplete")
                                                    <span class="badge badge-danger-lighten"> Incomplete </span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ url('admin-panel/dashboard/tasks', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="{{ url('admin-panel/dashboard/tasks', $task->id) }}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                    <a href="{{ url('admin-panel/dashboard/tasks/'. $task->id . '/edit') }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn action-icon show_confirm" data-toggle="tooltip" title='Delete'><i class="mdi mdi-delete"></i></button>
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
    </div>

    <x-slot name="script">
        <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>

        <script src="{{ asset('assets/js/pages/demo.datatable-init.js') }}"></script>
        <script src="{{ asset('assets/js/sweetalert2@11') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#DataTable').DataTable();

                $('#notification_alert').delay(3000).fadeOut('slow');

                $('.show_confirm').click(function(event) {
                    var form =  $(this).closest("form");
                    var name = $(this).data("name");

                    event.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to delete this item ?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    })
                    .then((willDelete) => {
                        if (willDelete.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    </x-slot>
</x-app-layout>
