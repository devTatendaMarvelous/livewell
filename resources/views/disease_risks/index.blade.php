<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <h5 class="mb-0">Disease Risk Forecasts</h5>
                            <a href="{{ route('disease-risks.create') }}" class="btn btn-sm btn-primary">Add New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Region</th>
                                        <th>Disease</th>
                                        <th>Risk Level</th>
                                        <th>Source</th>
                                        <th>Forecast Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($risks as $risk)
                                        <tr>
                                            <td>{{ $risk->region }}</td>
                                            <td>{{ $risk->disease_name }}</td>
                                            <td>
                                                @if($risk->risk_level == 'high')
                                                    <span class="badge bg-danger">High</span>
                                                @elseif($risk->risk_level == 'medium')
                                                    <span class="badge bg-warning">Medium</span>
                                                @else
                                                    <span class="badge bg-success">Low</span>
                                                @endif
                                            </td>
                                            <td>{{ $risk->source ?? '-' }}</td>
                                            <td>{{ $risk->forecast_date ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('disease-risks.edit', $risk->id) }}" class="avtar avtar-xs btn-link-secondary"><i class="ti ti-edit f-20"></i></a>
                                                <form action="{{ route('disease-risks.destroy', $risk->id) }}" method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="avtar avtar-xs btn-link-danger border-0 bg-transparent"><i class="ti ti-trash f-20"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $risks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-master>
