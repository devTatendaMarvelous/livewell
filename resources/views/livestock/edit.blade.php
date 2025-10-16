<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Edit Livestock</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('livestock.update', $livestock->id) }}" class="row gy-4" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-md-6">
                                        <label class="form-label">Farmer</label>
                                        <select name="user_id" class="form-select" required>
                                            @foreach($farmers as $farmer)
                                                <option value="{{ $farmer->id }}" {{ old('user_id', $livestock->user_id) == $farmer->id ? 'selected' : '' }}>
                                                    {{ $farmer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Tag Number</label>
                                        <input class="form-control" name="tag_number" value="{{ old('tag_number', $livestock->tag_number) }}" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Species</label>
                                        <input class="form-control" name="species" value="{{ old('species', $livestock->species) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Breed</label>
                                        <input class="form-control" name="breed" value="{{ old('breed', $livestock->breed) }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Age (years)</label>
                                        <input type="number" class="form-control" name="age" value="{{ old('age', $livestock->age) }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Sex</label>
                                        <select name="sex" class="form-select">
                                            <option value="male" {{ old('sex', $livestock->sex) == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('sex', $livestock->sex) == 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Weight (kg)</label>
                                        <input type="number" step="0.1" class="form-control" name="weight" value="{{ old('weight', $livestock->weight) }}">
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Update Livestock" class="btn btn-primary col-3">
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
