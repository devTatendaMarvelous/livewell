<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Add Health Record</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('health-records.store') }}" class="row gy-4" method="POST">
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
                                  <label class="form-label">Symptoms</label>
                                      <select name="symptoms[]" class="form-select" multiple required id="symptoms">
                                      <option value="">Select Symptom</option>
                                      @foreach($symptoms as $symptom)
                                          <option value="{{ $symptom }}">{{str_replace('_', ' ', $symptom)  }}</option>
                                      @endforeach
                                  </select>
                                  @error('symptoms')<p class="text-danger">{{ $message }}</p>@enderror
                              </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Signs</label>
                                        <select name="signs[]" class="form-select" multiple required id="signs">
                                            @foreach($signs as $sign)
                                                <option value="{{ $sign }}">{{ str_replace('_', ' ', $sign)   }}</option>
                                            @endforeach
                                        </select>
                                        @error('signs')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Attending Vet</label>
                                        <select name="vet_id" class="form-select">
                                            <option value="">Select Vet</option>
                                            @foreach($vets as $vet)
                                                <option value="{{ $vet->id }}">{{ $vet->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('vet_id')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Date Recorded</label>
                                        <input type="date" class="form-control" name="recorded_at">
                                        @error('recorded_at')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Add Record" class="btn btn-primary col-3">
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
