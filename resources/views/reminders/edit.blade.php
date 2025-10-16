<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Edit Reminder</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('reminders.update', $reminder->id) }}" class="row gy-4" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-md-6">
                                        <label class="form-label">User</label>
                                        <select name="user_id" class="form-select">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user_id', $reminder->user_id) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Livestock</label>
                                        <select name="livestock_id" class="form-select">
                                            <option value="">Select Livestock</option>
                                            @foreach($livestock as $animal)
                                                <option value="{{ $animal->id }}" {{ old('livestock_id', $reminder->livestock_id) == $animal->id ? 'selected' : '' }}>
                                                    {{ $animal->tag_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Type</label>
                                        <select name="type" class="form-select">
                                            <option value="vaccination" {{ old('type', $reminder->type) == 'vaccination' ? 'selected' : '' }}>Vaccination</option>
                                            <option value="treatment" {{ old('type', $reminder->type) == 'treatment' ? 'selected' : '' }}>Treatment</option>
                                            <option value="general" {{ old('type', $reminder->type) == 'general' ? 'selected' : '' }}>General</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Due Date</label>
                                        <input type="date" class="form-control" name="due_date" value="{{ $reminder->due_date ? $reminder->due_date->format('Y-m-d') : '' }}">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Message</label>
                                        <textarea class="form-control" name="message" rows="3">{{ old('message', $reminder->message) }}</textarea>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Update Reminder" class="btn btn-primary col-3">
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
