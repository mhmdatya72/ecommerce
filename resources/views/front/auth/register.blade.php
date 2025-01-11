<x-front-layout>
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="my-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index1.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register</li>
        </ol>
    </nav>
    <!-- End Breadcrumbs -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>{{ __('Register') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name">
                                <div class="text-danger mt-1">
                                    @error('name') {{ $message }} @enderror
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="username">
                                <div class="text-danger mt-1">
                                    @error('email') {{ $message }} @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
                                <div class="text-danger mt-1">
                                    @error('password') {{ $message }} @enderror
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                                <div class="text-danger mt-1">
                                    @error('password_confirmation') {{ $message }} @enderror
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('login') }}" class="text-decoration-none text-primary">
                                    {{ __('Already registered?') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
