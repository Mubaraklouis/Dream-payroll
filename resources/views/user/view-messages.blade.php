<x-employee-layout>
    @php
     $employee = auth()->user()->employee;   
    @endphp
    <main>
        <!-- Main Content Area -->
        <div class="container mt-5">
            <div class="row">
                <!-- Employee Information -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Employee Information
                        </div>
                        <div class="card-body">
                            <p><strong>Name:</strong> {{ $employee->name }}</p>
                            <p><strong>Email:</strong> {{ $employee->email }}</p>
                            <p><strong>Position:</strong> {{ $employee->job_title }}</p>
                            <p><strong>Department:</strong> {{ $employee->department }}</p>
                            <!-- Add more employee details as needed -->
                        </div>
                    </div>
                </div>

                <!-- Administrator Messages -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Messages from Administrator
                        </div>
                        <div class="card-body">
                            <!-- Message Example -->

                            @foreach ($employee->unreadNewsNotifications as $notification)
                                <div class="alert alert-info" role="alert">
                                    <h5 class="alert-heading">{{ $notification->data["title"] }}</h5>
                                    <p>{{ $notification->data["content"] }}</p>
                                    <hr>
                                    <p class="mb-0"><small>Posted on {{ $notification->created_at->format("j M Y") }} by Admin</small></p>
                                    @if ($notification->data['attachment'])
                                    <a href="{{ Storage::url($notification->data['attachment']) }}">Download attachment</a>
                                    @endif
                                    <form action="{{ route("notification.markAsRead", $notification) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Mark as read</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </main>
</x-employee-layout>
