<x-auth :headerText=" __(' Login with your email number')" >

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <input type="email" class="form-control form-control @error('email') is-invalid @enderror" name="email" id="floatingInput" placeholder="email Number">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control form-control @error('password') is-invalid @enderror" name="password" id="floatingInput" placeholder="password ">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <h6 class="f-w-500 mb-0">Don't have
                                an Account?</h6><a href="{{route('register')}}" class="link-primary">Create Account</a></div>

                    </form>

</x-auth>
