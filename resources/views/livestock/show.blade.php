<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="container py-4">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0"><i class="fas fa-cow me-2"></i>Livestock Profile</h2>
                    <div>
                        <a href="{{ route('livestock.edit', $livestock) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <a href="{{ route('livestock.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Livestock
                        </a>
                    </div>
                </div>

                <!-- Main Profile Card -->
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"><i class="fas fa-paw me-2"></i>{{ $livestock->name }}</h4>
                            <span class="badge bg-light text-dark fs-6">{{ $livestock->tag_number }}</span>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Basic Information -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-3">
                                <div class="info-box p-3 bg-light rounded">
                                    <label class="text-muted small mb-1"><i class="fas fa-tag me-2"></i>Species</label>
                                    <p class="mb-0 fw-semibold">{{ ucfirst($livestock->species) }}</p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="info-box p-3 bg-light rounded">
                                    <label class="text-muted small mb-1"><i class="fas fa-dna me-2"></i>Breed</label>
                                    <p class="mb-0 fw-semibold">{{ $livestock->breed ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="info-box p-3 bg-light rounded">
                                    <label class="text-muted small mb-1"><i class="fas fa-venus-mars me-2"></i>Gender</label>
                                    <p class="mb-0 fw-semibold">{{ ucfirst($livestock->sex) }}</p>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="info-box p-3 bg-light rounded">
                                    <label class="text-muted small mb-1"><i class="fas fa-birthday-cake me-2"></i>Age</label>
                                    <p class="mb-0 fw-semibold">{{ $livestock->age ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-box p-3 bg-light rounded">
                                    <label class="text-muted small mb-1"><i class="fas fa-calendar-alt me-2"></i>Date of Birth</label>
                                    <p class="mb-0 fw-semibold">{{ $livestock->date_of_birth ? \Carbon\Carbon::parse($livestock->date_of_birth)->format('F d, Y') : 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-box p-3 bg-light rounded">
                                    <label class="text-muted small mb-1"><i class="fas fa-weight me-2"></i>Weight</label>
                                    <p class="mb-0 fw-semibold">{{ $livestock->weight ?? 'N/A' }} kg</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-box p-3 bg-light rounded">
                                    <label class="text-muted small mb-1"><i class="fas fa-palette me-2"></i>Color</label>
                                    <p class="mb-0 fw-semibold">{{ $livestock->color ?? 'N/A' }}</p>
                                </div>
                            </div>

                            @if($livestock->notes)
                            <div class="col-md-12">
                                <div class="info-box p-3 bg-light rounded">
                                    <label class="text-muted small mb-1"><i class="fas fa-sticky-note me-2"></i>Notes</label>
                                    <p class="mb-0">{{ $livestock->notes }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer bg-light py-3">
                        <small class="text-muted">
                            <i class="fas fa-clock me-2"></i>Last updated: {{ $livestock->updated_at->diffForHumans() }}
                        </small>
                    </div>
                </div>

                <!-- Health Records Section -->
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-gradient-success text-white py-3">
                        <h5 class="mb-0"><i class="fas fa-notes-medical me-2"></i>Health Records</h5>
                    </div>
                    <div class="card-body p-4">
                        @if($livestock->healthRecords && $livestock->healthRecords->count() > 0)
                            <div class="row g-3">
                                @foreach($livestock->healthRecords as $record)
                                <div class="col-md-6">
                                    <div class="card border-start border-4 {{ $record->status == 'DIAGONISED' ? 'border-success' : 'border-warning' }}">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0">{{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}</h6>
                                                <span class="badge {{ $record->status == 'DIAGONISED' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ ucfirst($record->status) }}
                                                </span>
                                            </div>
                                            <p class="mb-1"><strong>Symptoms:</strong> {{ str_replace('_', ' ', $record->symptoms) }}</p>
                                            <p class="mb-1"><strong>Signs:</strong> {{ str_replace('_', ' ', $record->signs) }}</p>

                                            @if($record->status == 'DIAGONISED')
                                            <hr class="my-2">
                                            <p class="mb-1 text-primary"><strong>Diagnosis:</strong> {{ str_replace('_', ' ', $record->diagnosis) }}</p>
                                            <p class="mb-1 text-success"><strong>Treatment:</strong> {{ $record->treatment }}</p>
                                            <p class="mb-0 text-info"><strong>Prevention:</strong> {{ $record->prevention }}</p>
                                            @endif

                                            <div class="mt-2">
                                                <a href="{{ route('health-records.show', $record) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                                <p>No health records found for this livestock.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Vaccinations Section -->
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-gradient-info text-white py-3">
                        <h5 class="mb-0"><i class="fas fa-syringe me-2"></i>Vaccinations</h5>
                    </div>
                    <div class="card-body p-4">
                        @if($livestock->vaccinations && $livestock->vaccinations->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-syringe me-2"></i>Vaccine</th>
                                            <th><i class="fas fa-calendar me-2"></i>Date Given</th>
                                            <th><i class="fas fa-calendar-check me-2"></i>Next Due</th>
                                            <th><i class="fas fa-user-md me-2"></i>Administered By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($livestock->vaccinations as $vaccination)
                                        <tr>
                                            <td><strong>{{ $vaccination->vaccine_name }}</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($vaccination->date_given)->format('M d, Y') }}</td>
                                            <td>
                                                @if($vaccination->next_due_date)
                                                    <span class="badge bg-{{ \Carbon\Carbon::parse($vaccination->next_due_date)->isPast() ? 'danger' : 'success' }}">
                                                        {{ \Carbon\Carbon::parse($vaccination->next_due_date)->format('M d, Y') }}
                                                    </span>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $vaccination->vet->name ?? 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-syringe fa-3x mb-3"></i>
                                <p>No vaccination records found for this livestock.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Other Issues Section -->
                @if($livestock->issues && $livestock->issues->count() > 0)
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-gradient-warning text-white py-3">
                        <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Other Issues</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            @foreach($livestock->issues as $issue)
                            <div class="col-md-12">
                                <div class="card border-start border-4 border-warning">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0">{{ $issue->title }}</h6>
                                            <small class="text-muted">{{ $issue->created_at->format('M d, Y') }}</small>
                                        </div>
                                        <p class="mb-0">{{ $issue->description }}</p>
                                        @if($issue->resolved)
                                            <span class="badge bg-success mt-2">Resolved</span>
                                        @else
                                            <span class="badge bg-danger mt-2">Pending</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #64e36f 0%, #58cb92 100%);
        }
        .bg-gradient-success {
            background: linear-gradient(135deg, #48c774 0%, #11998e 100%);
        }
        .bg-gradient-info {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        }
        .bg-gradient-warning {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        }
        .info-box {
            transition: all 0.3s ease;
        }
        .info-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card {
            transition: all 0.3s ease;
        }
    </style>
</x-master>
