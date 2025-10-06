<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Add Vaccination</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('vaccinations.store') }}" class="row gy-4" method="POST">
                                    @csrf

                                    <div class="col-md-6">
                                        <label class="form-label">Livestock</label>
                                        <select name="livestock_id" class="form-select" required>
                                            <option value="">Select Livestock</option>
                                            @foreach($livestock as $animal)
                                                <option value="{{ $animal->id }}">{{ $animal->tag_number }}</option>
                                            @endforeach
                                        </select>
                                        @error('livestock_id')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Vaccine Name</label>
                                        <input class="form-control" name="vaccine_name" required>
                                        @error('vaccine_name')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Scheduled Date</label>
                                        <input type="date" class="form-control" name="scheduled_date" required>
                                        @error('scheduled_date')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Administered Date</label>
                                        <input type="date" class="form-control" name="administered_date">
                                        @error('administered_date')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Administered By (Vet)</label>
                                        <select name="administered_by" class="form-select">
                                            <option value="">Select Vet</option>
                                            @foreach($vets as $vet)
                                                <option value="{{ $vet->id }}">{{ $vet->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('administered_by')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Notes</label>
                                        <textarea class="form-control" name="notes" rows="3"></textarea>
                                        @error('notes')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Add Vaccination" class="btn btn-primary col-3">
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
