<x-front-layout>
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="my-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index1.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Login </li>
        </ol>
    </nav>
    <!-- End Breadcrumbs -->

    <!-- Session Status -->
    <x-auth-session-status class="alert alert-success mb-4" :status="session('status')" />

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>{{ __('Login') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
                                <div class="text-danger mt-1">
                                    @error('email') {{ $message }} @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                                <div class="text-danger mt-1">
                                    @error('password') {{ $message }} @enderror
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-3">
                                <input type="checkbox" id="remember_me" name="remember" class="form-check-input">
                                <label for="remember_me" class="form-check-label">
                                    {{ __('Remember me') }}
                                </label>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between align-items-center">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Log in') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
