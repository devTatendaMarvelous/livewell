<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <h5 class="mb-0">Vaccinations</h5>
                            <a href="{{ route('vaccinations.create') }}" class="btn btn-sm btn-primary">Add New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Livestock Tag</th>
                                        <th>Vaccine Name</th>
                                        <th>Scheduled</th>
                                        <th>Administered</th>
                                        <th>Admin By</th>
                                        <th>Notes</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vaccinations as $v)
                                        <tr>
                                            <td>{{ $v->livestock->tag_number ?? 'N/A' }}</td>
                                            <td>{{ $v->vaccine_name }}</td>
                                            <td>{{ $v->scheduled_date }}</td>
                                            <td>{{ $v->administered_date ?? '-' }}</td>
                                            <td>{{ $v->administered_by ? $v->vet->name : 'N/A' }}</td>
                                            <td>{{ Str::limit($v->notes, 30) }}</td>
                                            <td>
{{--                                                <a href="{{ route('vaccinations.show', $v->id) }}" class="avtar avtar-xs btn-link-secondary"><i class="ti ti-eye f-20"></i></a>--}}
                                                <a href="{{ route('vaccinations.edit', $v->id) }}" class="avtar avtar-xs btn-link-secondary"><i class="ti ti-edit f-20"></i></a>
                                                <form action="{{ route('vaccinations.destroy', $v->id) }}" method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="avtar avtar-xs btn-link-danger border-0 bg-transparent"><i class="ti ti-trash f-20"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $vaccinations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-master>
