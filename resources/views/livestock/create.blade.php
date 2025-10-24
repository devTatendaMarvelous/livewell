<x-master>
    <!-- Add these in your Blade file, preferably before </body> -->

    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Add New Livestock</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('livestock.store') }}" class="row gy-4" method="POST">
                                    @csrf

                                    <div class="col-md-4">
                                        <label class="form-label">Farmer</label>
                                        <select name="user_id" class="form-select" required>
                                            <option value="">Select Farmer</option>
                                            @foreach($farmers as $farmer)
                                                <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Tag Number</label>
                                        <input class="form-control" name="tag_number" required>
                                        @error('tag_number')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <!-- Ages Select -->
                                    <div class="col-md-4 mb-3">
                                        <label for="age" class="form-label">Age</label>
                                        <select name="age" id="age" class="form-control select2">
                                            @foreach($ages as $age)
                                                <option value="{{ $age }}">{{ $age }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Species Select -->
                                    <div class="col-md-3 mb-3">
                                        <label for="species" class="form-label">Species</label>
                                        <select name="species" id="species" class="form-control select2" required>
                                            @foreach($species as $specie)
                                                <option value="{{ $specie }}">{{ $specie }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <!-- Breeds Select -->
                                    <div class="col-md-3 mb-3">
                                        <label for="breed" class="form-label">Breed</label>
                                        <select name="breed" id="breed" class="form-control select2"  required></select>
                                    </div>


                                    <div class="col-md-3">
                                        <label class="form-label">Sex</label>
                                        <select name="sex" class="form-select">
                                            <option value="">Select</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        @error('sex')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Weight (kg)</label>
                                        <input type="number" step="0.1" class="form-control" name="weight">
                                        @error('weight')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Add Livestock" class="btn btn-primary col-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // expose PHP species-keyed arrays to JS

        const BREEDS_BY_SPECIES = @json($breeds); // pass species => [breeds] from controller

        // helper to clear and populate a select element (value = raw item, text = pretty)
        function populateSelect(selector, items, single = false) {
            const $sel = $(selector);
            $sel.empty();
            if (!Array.isArray(items) || items.length === 0) {
                $sel.prop('disabled', true);
                $sel.trigger('change');
                return;
            }
            $sel.prop('disabled', false);
            items.forEach(item => {
                const text = String(item).replace(/_/g, ' ');
                const option = new Option(text, item, false, false);
                $sel.append(option);
            });
            if (single) {
                // optionally select first item (comment out if you don't want auto-select)
                // $sel.val(items[0]).trigger('change');
            }
            $sel.trigger('change');
        }

        $(document).ready(function() {
            // initialize Select2 for selects
            $('#breed').select2({ placeholder: 'Select breed', allowClear: true, width: '100%' });

            // update selects for chosen species
            function updateForSpecies(species) {
                const s = String(species);
                populateSelect('#breed', BREEDS_BY_SPECIES[s] ?? [], true);
            }

            $('#species').on('change', function() {
                updateForSpecies(this.value);
            });

            // initial populate on load
            const initialSpecies = $('#species').val();
            if (initialSpecies) {
                updateForSpecies(initialSpecies);
            } else {
                populateSelect('#symptoms', []);
                populateSelect('#key_signs', []);
                populateSelect('#breed', []);
            }

            // ensure breed is cleared when form resets after submission
            // (this mirrors clearing for symptoms/key_signs in your submit handler)
        });
    </script>

</x-master>
