@extends('layouts.app')

@section('content')
    <h3 class="page-title">Tasks Management</h3>
    <p class="text-right">
        <button class="btn btn-success" data-toggle="modal" data-target="#taskModal">
            <i class="fa fa-plus"></i> Add New Task
        </button>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span>List</span>
        </div>

        <div class="panel-body table-responsive">
            <table class="table text-center table-bordered table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->due_date }}</td>
                            <td>{{ $task->user->name }}</td>
                            <td>
                                @if ($task->status == 'Pending')
                                    <span class="badge badge-warning status-badge" data-task-id="{{ $task->id }}"
                                        data-current-status="{{ $task->status }}">{{ $task->status }}</span>
                                @elseif($task->status == 'In Progress')
                                    <span class="badge badge-info status-badge" data-task-id="{{ $task->id }}"
                                        data-current-status="{{ $task->status }}">{{ $task->status }}</span>
                                @else
                                    <span class="badge badge-success status-badge" data-task-id="{{ $task->id }}"
                                        data-current-status="{{ $task->status }}">{{ $task->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary btn-sm" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Adding Task -->
    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Add New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="taskTitle">Title</label>
                            <input type="text" id="taskTitle" name="title" class="form-control" required
                                placeholder="Enter Task Title">
                        </div>
                        <div class="form-group">
                            <label for="taskDescription">Description</label>
                            <textarea id="taskDescription" name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="taskDueDate">Due Date</label>
                            <input type="date" id="taskDueDate" name="due_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="taskUser">Assign User</label>
                            <select id="taskUser" name="user_id" class="form-control" required>
                                <option value="" disabled selected>Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Update Task Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="statusUpdateForm" method="POST" action="{{ route('tasks.updateStatus') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="task_id" id="task_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">Select Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        document.querySelectorAll('.status-badge').forEach(function(badge) {
            badge.addEventListener('click', function() {
                var taskId = this.getAttribute('data-task-id');
                var currentStatus = this.getAttribute('data-current-status');
                document.getElementById('task_id').value = taskId;

                document.getElementById('status').value = currentStatus;

                $('#statusModal').modal('show');
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        table th,
        table td {
            text-align: center;
            background-color: #f5f5f5;
            vertical-align: middle;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table td {
            border-bottom: 1px solid #ddd;
        }

        .btn-sm {
            margin: 0 5px;
            padding: 5px 8px;
            font-size: 12px;
        }

        .fa {
            font-size: 14px;
        }

        .btn-primary,
        .btn-danger {
            width: 30px;
            height: 30px;
            padding: 0;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .btn-primary:hover,
        .btn-danger:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        tbody tr:hover {
            background-color: #f0f0f0;
        }

        .modal-content {
            border-radius: 8px;
        }

        .modal-header {
            border-bottom: 1px solid #ddd;
        }

        .form-group label {
            font-weight: bold;
        }

        .modal-footer button {
            min-width: 120px;
        }

        .modal-body {
            padding: 20px;
        }

        @media (max-width: 768px) {
            .modal-dialog {
                max-width: 100%;
                margin: 10px;
            }
        }
    </style>
@endsection
