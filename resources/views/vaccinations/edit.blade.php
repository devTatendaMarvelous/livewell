<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Edit Vaccination</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('vaccinations.update', $vaccination->id) }}" class="row gy-4" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-md-6">
                                        <label class="form-label">Livestock</label>
                                        <select name="livestock_id" class="form-select" required>
                                            @foreach($livestock as $animal)
                                                <option value="{{ $animal->id }}" {{ old('livestock_id', $vaccination->livestock_id) == $animal->id ? 'selected' : '' }}>
                                                    {{ $animal->tag_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Vaccine Name</label>
                                        <input class="form-control" name="vaccine_name" value="{{ old('vaccine_name', $vaccination->vaccine_name) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Scheduled Date</label>
                                        <input type="date" class="form-control" name="scheduled_date" value="{{ old('scheduled_date', $vaccination->scheduled_date) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Administered Date</label>
                                        <input type="date" class="form-control" name="administered_date" value="{{ old('administered_date', $vaccination->administered_date) }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Administered By (Vet)</label>
                                        <select name="administered_by" class="form-select">
                                            <option value="">Select Vet</option>
                                            @foreach($vets as $vet)
                                                <option value="{{ $vet->id }}" {{ old('administered_by', $vaccination->administered_by) == $vet->id ? 'selected' : '' }}>
                                                    {{ $vet->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Notes</label>
                                        <textarea class="form-control" name="notes" rows="3">{{ old('notes', $vaccination->notes) }}</textarea>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Update Vaccination" class="btn btn-primary col-3">
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
