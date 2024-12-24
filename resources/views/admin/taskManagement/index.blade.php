@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div id="successMessage" class="alert alert-success" style="display:none;">
            {{ session('success') }}
        </div>
    @endif
    <h3 class="page-title">Tasks Management</h3>

    <div class="d-flex justify-content-between mb-3">
        <!-- Status Filter -->
        <form method="GET" action="{{ route('tasks.index') }}" class="form-inline">
            <div class="form-group mr-2">
                <label for="statusFilter" class="mr-2">Status:</label>
                <select name="status" id="statusFilter" class="form-control">
                    <option value="">All</option>
                    <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ request('status') === 'In Progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Search</button>
        </form>
    </div>


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
                            <td style="text-align: left">{{ $task->title }}</td>
                            <td style="text-align: left">{{ $task->description }}</td>
                            <td>{{ $task->due_date }}</td>
                            <td>{{ $task->user->name }}</td>
                            <td>
                                <span class="badge status-badge" id="status-id" data-task-id="{{ $task->id }}"
                                    data-current-status="{{ $task->status }}"
                                    style="background-color:
                                        {{ $task->status === 'Completed' ? '#28a745' : ($task->status === 'In Progress' ? '#ffc107' : '#6c757d') }};">
                                    {{ $task->status }}
                                </span>
                            </td>

                            <td>
                                <button type="button" class="btn btn-primary btn-sm edit-task" data-toggle="modal"
                                    data-target="#editTaskModal" data-id="{{ $task->id }}"
                                    data-title="{{ $task->title }}" data-description="{{ $task->description }}"
                                    data-due-date="{{ $task->due_date }}" data-user-id="{{ $task->user_id }}"
                                    title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
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

    {{-- Modal for Adding Task --}}
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

    {{-- Edit Task Modal --}}
    <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editTaskForm" method="POST" action="{{ route('tasks.update', 'task_id') }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editTaskTitle">Title</label>
                            <input type="text" id="editTaskTitle" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editTaskDescription">Description</label>
                            <textarea id="editTaskDescription" name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editTaskDueDate">Due Date</label>
                            <input type="date" id="editTaskDueDate" name="due_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editTaskUser">Assign User</label>
                            <select id="editTaskUser" name="user_id" class="form-control" required>
                                <option value="" disabled selected>Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Status Update Modal --}}
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
                <form id="statusUpdateForm" method="POST" action="{{ route('tasks.status') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="task_id" name="task_id" value="">
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
        @if (session('success'))
            setTimeout(function() {
                var successMessage = document.getElementById('successMessage');
                successMessage.style.display = 'block';

                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 3000);
            }, 100);
        @endif


        document.querySelectorAll('.edit-task').forEach(function(button) {
            button.addEventListener('click', function() {
                var taskId = this.getAttribute('data-id');
                var taskTitle = this.getAttribute('data-title');
                var taskDescription = this.getAttribute('data-description');
                var taskDueDate = this.getAttribute('data-due-date');
                var userId = this.getAttribute('data-user-id');

                document.getElementById('editTaskTitle').value = taskTitle;
                document.getElementById('editTaskDescription').value = taskDescription;
                document.getElementById('editTaskDueDate').value = taskDueDate;
                document.getElementById('editTaskUser').value = userId;

                document.getElementById('editTaskForm').action = '/tasks/' + taskId;
            });
        });

        document.querySelectorAll('.status-badge').forEach(function(badge) {
            badge.addEventListener('click', function() {
                var taskId = this.getAttribute('data-task-id');
                var currentStatus = this.getAttribute('data-current-status');

                var taskInput = document.getElementById('task_id');
                var statusSelect = document.getElementById('status');

                if (taskInput && statusSelect) {
                    taskInput.value = taskId;
                    statusSelect.value = currentStatus;
                    $('#statusModal').modal('show');
                }

                updateStatusBadgeColor(taskId, currentStatus);
            });
        });

        $('#statusUpdateForm').submit(function(e) {
            e.preventDefault();

            var taskId = $('#task_id').val();
            console.log('task : ', taskId);
            // Ensure task_id is properly captured
            var newStatus = $('#status').val(); // Get selected status

            $.ajax({
                url: '/tasks/update-status', // Ensure the correct URL
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token for security
                    task_id: taskId, // Add task_id to the request
                    status: newStatus, // Add the selected status
                },
                success: function(response) {
                    $('#statusModal').modal('hide');
                },
                error: function(xhr) {
                    console.error('Error updating status:', xhr);
                }
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        .status-badge {
            cursor: pointer;
        }

        table th {
            text-align: center;
            background-color: #007bff;
            color: white;
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
