<x-auth :headerText=" __('Enter OTP sent to your mobile number')">
{{--    <p>OTP: {{$otp}}</p>--}}
    <form method="POST" action="{{ route('members.otp') }}">
        @csrf
        <div class="mb-3">
            <input class="form-control form-control " name="otp" placeholder="Enter OTP">
        </div>
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</x-auth>
