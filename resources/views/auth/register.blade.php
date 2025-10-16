<x-auth :headerText=" __(' Create Account')">
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <input class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name">
        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
        @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <input class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone">
        @error('phone')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <select class="form-select @error('role') is-invalid @enderror" name="role">
            <option selected disabled>Select Role</option>
            <option value="farmer">Farmer</option>
            <option value="vet">Vet</option>
        </select>
        @error('role')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
        @error('password')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <input class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address">
        @error('address')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="d-grid mt-4">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>

</x-auth>
