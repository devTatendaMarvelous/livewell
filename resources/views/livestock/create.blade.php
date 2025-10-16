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

                                    <div class="col-md-6">
                                        <label class="form-label">Farmer</label>
                                        <select name="user_id" class="form-select" required>
                                            <option value="">Select Farmer</option>
                                            @foreach($farmers as $farmer)
                                                <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Tag Number</label>
                                        <input class="form-control" name="tag_number" required>
                                        @error('tag_number')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <!-- Ages Select -->
                                    <div class="col-md-6 mb-3">
                                        <label for="age" class="form-label">Age</label>
                                        <select name="age" id="age" class="form-control select2">
                                            @foreach($ages as $age)
                                                <option value="{{ $age }}">{{ $age }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Breeds Select -->
                                    <div class="col-md-6 mb-3">
                                        <label for="breed" class="form-label">Breed</label>
                                        <select name="breed" id="breed" class="form-control select2">

                                            @foreach($breeds as $breed)
                                                <option value="{{ $breed }}">{{ $breed }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Species Select -->
                                    <div class="col-md-6 mb-3">
                                        <label for="species" class="form-label">Species</label>
                                        <select name="species" id="species" class="form-control select2" required>

                                            @foreach($species as $specie)
                                                <option value="{{ $specie }}">{{ $specie }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="col-md-6">
                                        <label class="form-label">Sex</label>
                                        <select name="sex" class="form-select">
                                            <option value="">Select</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        @error('sex')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
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


</x-master>
