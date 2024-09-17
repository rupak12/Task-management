@extends('task.layouts.main')
@section('content')
    <!--start content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Task Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Task List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('createTask') }}" class="btn btn-primary">Add TASK</a>

                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0">Task Details</h5>
                    <form class="d-flex ms-auto align-items-center">
                        <button type="button" class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal"
                            data-bs-target="#advFilterTaskModal">
                            Advance Filter
                        </button>

                        <div class="position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                <i class="bi bi-search"></i>
                            </div>
                            <input class="form-control ps-5" type="text" placeholder="search">
                        </div>
                    </form>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due date</th>
                                <th>priority level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tasksList">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!--end page main-->


    <!-- Advance Task filter Modal -->
    <div class="modal fade" id="advFilterTaskModal" tabindex="-1" aria-labelledby="advFilterTaskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="advFilterTaskModalLabel">Advance Filter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="adv-task-filter">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Priority Level Selector -->
                            <div class="col-md-6 mb-3">
                                <label for="priority" class="form-label">Priority level</label>
                                <select class="form-select" name="priority">
                                    <option selected disabled value="">Choose...</option>
                                    @foreach (App\Models\Task::PRIORITY as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Due Date Selector -->
                            <div class="col-md-6 mb-3">
                                <label for="due_date" class="form-label">Due date</label>
                                <input type="date" class="form-control" name="due_date">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"
                            onclick="window.location.href='{{ route('taskList') }}'">Remove filter</button>
                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Destroy Task Modal -->
    <div class="modal fade" id="destroyTaskModal" tabindex="-1" aria-labelledby="destroyTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="destroyTaskModalLabel">Delete Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="universal-post" action="{{ route('destroyTask') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="destroyTaskId">
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Task Modal -->
    <div class="modal fade" id="viewTaskModal" tabindex="-1" aria-labelledby="viewTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewTaskModalLabel">View Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Title:</strong>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control-plaintext" id="taskTitle" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Description:</strong>
                            </div>
                            <div class="col-sm-8">
                                <textarea class="form-control-plaintext" id="taskDescription" rows="3" readonly></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Due Date:</strong>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control-plaintext" id="taskDueDate" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Priority:</strong>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control-plaintext" id="taskPriority" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var fetchTasksUrl = "{{ route('fetchTasks') }}";
        var fetchTasksFilteredUrl = "{{ route('fetchTasks') }}";
        $(function() {
            // Fetch tasks and display them
            fetchTasks();
        });
    </script>
@endsection
