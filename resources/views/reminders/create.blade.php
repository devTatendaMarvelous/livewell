<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Add Reminder</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('reminders.store') }}" class="row gy-4" method="POST">
                                    @csrf

                                    <div class="col-md-6">
                                        <label class="form-label">User</label>
                                        <select name="user_id" class="form-select" required>
                                            <option value="">Select User</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Livestock</label>
                                        <select name="livestock_id" class="form-select">
                                            <option value="">Select Livestock</option>
                                            @foreach($livestock as $animal)
                                                <option value="{{ $animal->id }}">{{ $animal->tag_number }}</option>
                                            @endforeach
                                        </select>
                                        @error('livestock_id')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Reminder Type</label>
                                        <select name="type" class="form-select" required>
                                            <option value="vaccination">Vaccination</option>
                                            <option value="treatment">Treatment</option>
                                            <option value="general">General</option>
                                        </select>
                                        @error('type')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Due Date</label>
                                        <input type="date" class="form-control" name="due_date" required>
                                        @error('due_date')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Message</label>
                                        <textarea class="form-control" name="message" rows="3" required></textarea>
                                        @error('message')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Add Reminder" class="btn btn-primary col-3">
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
