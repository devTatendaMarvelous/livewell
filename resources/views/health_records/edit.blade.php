<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Edit Health Record</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('health-records.update', $healthRecord->id) }}" class="row gy-4" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-md-6">
                                        <label class="form-label">Livestock</label>
                                        <select name="livestock_id" class="form-select" required>
                                            @foreach($livestock as $animal)
                                                <option value="{{ $animal->id }}" {{ old('livestock_id', $healthRecord->livestock_id) == $animal->id ? 'selected' : '' }}>
                                                    {{ $animal->tag_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Symptoms</label>
                                        <input class="form-control" name="symptoms" value="{{ old('symptoms', $healthRecord->symptoms) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Diagnosis</label>
                                        <input class="form-control" name="diagnosis" value="{{ old('diagnosis', $healthRecord->diagnosis) }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Treatment</label>
                                        <input class="form-control" name="treatment" value="{{ old('treatment', $healthRecord->treatment) }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Vet</label>
                                        <select name="vet_id" class="form-select">
                                            <option value="">Select Vet</option>
                                            @foreach($vets as $vet)
                                                <option value="{{ $vet->id }}" {{ old('vet_id', $healthRecord->vet_id) == $vet->id ? 'selected' : '' }}>
                                                    {{ $vet->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Recorded Date</label>
                                        <input type="date" class="form-control" name="recorded_at" value="{{ old('recorded_at', $healthRecord->recorded_at) }}">
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Update Record" class="btn btn-primary col-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-master>
