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
                                        <select name="livestock_id" class="form-select" required id="livestock-select">
                                            <option value="">Select Livestock</option>
                                            @foreach($livestock as $animal)
                                                <option value="{{ $animal->id }}" data-species="{{ $animal->species }}">{{ $animal->tag_number }} — {{ $animal->species }}</option>
                                            @endforeach
                                        </select>
                                        @error('livestock_id')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Symptoms</label>
                                        <select name="symptoms[]" class="form-select" multiple required id="symptoms"></select>
                                        @error('symptoms')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Signs</label>
                                        <select name="signs[]" class="form-select" multiple required id="signs">
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

<script>
    (function() {
        const speciesSymptoms = @json($symptoms);
        const speciesSigns = @json($signs);
        const livestockSelect = document.getElementById('livestock-select');
        const symptomsSelect = document.getElementById('symptoms');
        const signsSelect = document.getElementById('signs');

        function setOptions(selectEl, items, placeholder) {
            // preserve previously selected values if they still exist
            const prev = Array.from(selectEl.selectedOptions).map(o => o.value);
            selectEl.innerHTML = '';
            // Add placeholder for usability when empty
            const ph = document.createElement('option');
            ph.value = '';
            ph.textContent = items && items.length ? (placeholder || 'Select options') : 'No options for this species';
            ph.disabled = true;
            ph.selected = true;
            selectEl.appendChild(ph);

            if (!Array.isArray(items)) return;
            items.forEach(val => {
                const opt = document.createElement('option');
                opt.value = val;
                opt.textContent = val.replaceAll('_',' ');
                if (prev.includes(val)) opt.selected = true;
                selectEl.appendChild(opt);
            });
        }

        function updateBySpecies(sp) {
            const sympt = speciesSymptoms && speciesSymptoms[sp] ? speciesSymptoms[sp] : [];
            const sgns = speciesSigns && speciesSigns[sp] ? speciesSigns[sp] : [];
            setOptions(symptomsSelect, sympt, 'Select symptoms');
            setOptions(signsSelect, sgns, 'Select signs');
        }

        livestockSelect?.addEventListener('change', function() {
            const sp = this.options[this.selectedIndex]?.dataset?.species;
            updateBySpecies(sp);
        });

        // Initialize on load if an option is pre-selected
        window.addEventListener('DOMContentLoaded', function() {
            const selected = livestockSelect?.options[livestockSelect.selectedIndex];
            const sp = selected ? selected.dataset.species : null;
            if (sp) {
                updateBySpecies(sp);
            } else {
                // default to empty lists
                setOptions(symptomsSelect, []);
                setOptions(signsSelect, []);
            }
        });
    })();
</script>

</x-master>
