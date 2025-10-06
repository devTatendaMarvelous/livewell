<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Edit Disease Risk</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('disease-risks.update', $diseaseRisk->id) }}" class="row gy-4" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-md-6">
                                        <label class="form-label">Region</label>
                                        <input class="form-control" name="region" value="{{ old('region', $diseaseRisk->region) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Disease Name</label>
                                        <input class="form-control" name="disease_name" value="{{ old('disease_name', $diseaseRisk->disease_name) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Risk Level</label>
                                        <select name="risk_level" class="form-select" required>
                                            <option value="low" {{ old('risk_level', $diseaseRisk->risk_level) == 'low' ? 'selected' : '' }}>Low</option>
                                            <option value="medium" {{ old('risk_level', $diseaseRisk->risk_level) == 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="high" {{ old('risk_level', $diseaseRisk->risk_level) == 'high' ? 'selected' : '' }}>High</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Forecast Date</label>
                                        <input type="date" class="form-control" name="forecast_date" value="{{ old('forecast_date', $diseaseRisk->forecast_date) }}">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Source</label>
                                        <input class="form-control" name="source" value="{{ old('source', $diseaseRisk->source) }}">
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Update Disease Risk" class="btn btn-primary col-3">
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
