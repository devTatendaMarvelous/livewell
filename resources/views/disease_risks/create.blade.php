<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Add Disease Risk Forecast</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('disease-risks.store') }}" class="row gy-4" method="POST">
                                    @csrf

                                    <div class="col-md-6">
                                        <label class="form-label">Region</label>
                                        <input class="form-control" name="region" required>
                                        @error('region')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Disease Name</label>
                                        <input class="form-control" name="disease_name" required>
                                        @error('disease_name')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Risk Level</label>
                                        <select name="risk_level" class="form-select" required>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                        @error('risk_level')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Forecast Date</label>
                                        <input type="date" class="form-control" name="forecast_date">
                                        @error('forecast_date')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Source</label>
                                        <input class="form-control" name="source">
                                        @error('source')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Add Disease Risk" class="btn btn-primary col-3">
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
