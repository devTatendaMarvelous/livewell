<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <h5 class="mb-0">Livestock</h5>
                            <a href="{{ route('livestock.create') }}" class="btn btn-sm btn-primary">Add New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                    <tr>
                                        <th>Tag #</th>
                                        <th>Species</th>
                                        <th>Breed</th>
                                        <th>Age</th>
                                        <th>Sex</th>
                                        <th>Weight (kg)</th>
                                        <th>Owner</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($livestock as $animal)
                                        <tr>
                                            <td>{{ $animal->tag_number }}</td>
                                            <td>{{ ucfirst($animal->species) }}</td>
                                            <td>{{ $animal->breed ?? '-' }}</td>
                                            <td>{{ $animal->age ?? '-' }}</td>
                                            <td>{{ ucfirst($animal->sex ?? '-') }}</td>
                                            <td>{{ $animal->weight ?? '-' }}</td>
                                            <td>{{ $animal->user->name ?? 'Unknown' }}</td>
                                            <td>
                                                <a href="{{ route('livestock.show', $animal->id) }}" class="avtar avtar-xs btn-link-secondary"><i class="ti ti-eye f-20"></i></a>
                                                <a href="{{ route('livestock.edit', $animal->id) }}" class="avtar avtar-xs btn-link-secondary"><i class="ti ti-edit f-20"></i></a>
                                                <form action="{{ route('livestock.destroy', $animal->id) }}" method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="avtar avtar-xs btn-link-danger border-0 bg-transparent"><i class="ti ti-trash f-20"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $livestock->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-master>
