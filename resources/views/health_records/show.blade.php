<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="container py-4">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0"><i class="fas fa-notes-medical me-2"></i>Health Record Details</h2>
                    <a href="{{ route('health-records.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Records
                    </a>
                </div>

                <!-- Main Card -->
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"><i class="fas fa-paw me-2"></i>#{{ $healthRecord->livestock->tag_number??'kww' }} :{{ $healthRecord->livestock->species??'kww' }} {{ $healthRecord->livestock->breed??'kww' }}</h4>
                            <span
                                class="badge {{ $healthRecord->status == 'DIAGONISED' ? 'bg-success' : 'bg-warning' }} fs-6">
                                            {{ ucfirst($healthRecord->status) }}
                                        </span>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Basic Information -->
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-box p-3 bg-light rounded">
                                    <label class="text-muted small mb-1"><i
                                            class="fas fa-calendar-alt me-2"></i>Date</label>
                                    <p class="mb-0 fw-semibold">{{ \Carbon\Carbon::parse($healthRecord->date)->format('F d, Y') }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box p-3 bg-light rounded">
                                    <label class="text-muted small mb-1"><i
                                            class="fas fa-heartbeat me-2"></i>Symptoms</label>
                                    <p class="mb-0 fw-semibold">{{ str_replace('_', ' ', $healthRecord->symptoms) }}</p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="info-box p-3 bg-light rounded">
                                    <label class="text-muted small mb-1"><i
                                            class="fas fa-stethoscope me-2"></i>Signs</label>
                                    <p class="mb-0 fw-semibold">{{ str_replace('_', ' ', $healthRecord->signs) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Diagnosis Section -->
                        @if($healthRecord->status == 'DIAGONISED')
                            <hr class="my-4">
                            <div class="diagnosis-section">
                                <h5 class="mb-4 text-primary">
                                    <i class="fas fa-file-medical-alt me-2"></i>Diagnosis Information
                                </h5>

                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <div class="info-box p-3 border border-primary rounded">
                                            <label class="text-primary small mb-2"><i class="fas fa-diagnoses me-2"></i>Diagnosis</label>
                                            <p class="mb-0 fs-5">{{ str_replace('_', ' ', $healthRecord->diagnosis) }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-box p-3 border border-success rounded">
                                            <label class="text-success small mb-2"><i class="fas fa-pills me-2"></i>Treatment</label>
                                            <p class="mb-0">{{ $healthRecord->treatment }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-box p-3 border border-info rounded">
                                            <label class="text-info small mb-2"><i class="fas fa-shield-alt me-2"></i>Prevention</label>
                                            <p class="mb-0">{{ $healthRecord->prevention }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer bg-light py-3">
                        <small class="text-muted">
                            <i class="fas fa-clock me-2"></i>Last
                            updated: {{ $healthRecord->updated_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #64e36f 0%, #58cb92 100%);
        }

        .info-box {
            transition: all 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</x-master>
