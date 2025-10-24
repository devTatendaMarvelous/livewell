<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <h5 class="mb-0">Health Records</h5>
                            <a href="{{ route('health-records.create') }}" class="btn btn-sm btn-primary">Add New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Livestock Tag</th>
                                        <th>Symptoms</th>
                                        <th>Diagnosis</th>
                                        <th>Treatment</th>
                                        <th>Vet</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{ $record->livestock->tag_number ?? 'N/A' }}</td>
                                            <td>{{ Str::limit($record->symptoms, 30) }}</td>
                                            <td>{{ $record->diagnosis ?? '-' }}</td>
                                            <td>{{ Str::limit($record->treatment, 30) }}</td>
                                            <td>{{ $record->vet->name ?? 'N/A' }}</td>
                                            <td>{{ $record->status ?? 'N/A' }}</td>
                                            <td>{{ $record->recorded_at ?? '-' }}</td>
                                            <td>
                                                @if($record->status === 'PENDING')
                                                <a class="btn btn-primary" href="{{route('health-records.diagnose',[$record->id])}}">Diagonise</a>
                                                @endif
                                                <a href="{{ route('health-records.show', $record->id) }}" class="avtar avtar-xs btn-link-secondary"><i class="ti ti-eye f-20"></i></a>
                                              @if($record->status === 'PENDING')
{{--                                                <a href="{{ route('health-records.edit', $record->id) }}" class="avtar avtar-xs btn-link-secondary"><i class="ti ti-edit f-20"></i></a>--}}
                                                <form action="{{ route('health-records.destroy', $record->id) }}" method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="avtar avtar-xs btn-link-danger border-0 bg-transparent"><i class="ti ti-trash f-20"></i></button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $records->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-master>
