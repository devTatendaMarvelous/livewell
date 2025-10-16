<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <h5 class="mb-0">Reminders</h5>
                            <a href="{{ route('reminders.create') }}" class="btn btn-sm btn-primary">Add New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Livestock</th>
                                        <th>Type</th>
                                        <th>Message</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reminders as $reminder)
                                        <tr>
                                            <td>{{ $reminder->user->name }}</td>
                                            <td>{{ $reminder->livestock->tag_number ?? '-' }}</td>
                                            <td>{{ ucfirst($reminder->type) }}</td>
                                            <td>{{ Str::limit($reminder->message, 40) }}</td>
                                            <td>{{ $reminder->due_date }}</td>
                                            <td>
                                                @if($reminder->sent_status)
                                                    <span class="badge bg-success">Sent</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('reminders.edit', $reminder->id) }}" class="avtar avtar-xs btn-link-secondary"><i class="ti ti-edit f-20"></i></a>
                                                <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="avtar avtar-xs btn-link-danger border-0 bg-transparent"><i class="ti ti-trash f-20"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $reminders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-master>
