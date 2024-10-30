@if ($errors->any())
<div class="alert alert-danger">
    <h3>Error Occurred</h3>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- First Name -->
<div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->profile->first_name ?? '') }}" class="form-control" placeholder="Enter your first name">
</div>

<!-- Last Name -->
<div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->profile->last_name ?? '') }}" class="form-control" placeholder="Enter your last name">
</div>

<!-- Birthday -->
<div class="form-group">
    <label for="birthday">Birthday</label>
    <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $user->profile->birthday ?? '') }}" class="form-control">
</div>

<!-- Gender -->
<div class="form-group">
    <label>Gender</label>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="male" {{ old('gender', $user->profile->gender ?? '') == 'male' ? 'checked' : '' }}>
            <label class="form-check-label">Male</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="female" {{ old('gender', $user->profile->gender ?? '') == 'female' ? 'checked' : '' }}>
            <label class="form-check-label">Female</label>
        </div>
    </div>
</div>

<!-- Street Address -->
<div class="form-group">
    <label for="street_address">Street Address</label>
    <input type="text" name="street_address" id="street_address" value="{{ old('street_address', $user->profile->street_address ?? '') }}" class="form-control" placeholder="Enter street address">
</div>

<!-- City -->
<div class="form-group">
    <label for="city">City</label>
    <input type="text" name="city" id="city" value="{{ old('city', $user->profile->city ?? '') }}" class="form-control" placeholder="Enter city">
</div>

<!-- State -->
<div class="form-group">
    <label for="state">State</label>
    <input type="text" name="state" id="state" value="{{ old('state', $user->profile->state ?? '') }}" class="form-control" placeholder="Enter state">
</div>

<!-- Postal Code -->
<div class="form-group">
    <label for="postal_code">Postal Code</label>
    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $user->profile->postal_code ?? '') }}" class="form-control" placeholder="Enter postal code">
</div>

<!-- Country -->
<div class="form-group">
    <label for="country">Country</label>
    <select name="country" id="country" class="form-control">
        @foreach($countries as $code => $name)
        <option value="{{ $code }}" {{ old('country', $user->profile->country ?? '') == $code ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
</div>

<!-- Locale -->
<div class="form-group">
    <label for="locale">Language Preference</label>
    <select name="locale" id="locale" class="form-control">
        @foreach($locales as $localeCode => $localeName)
        <option value="{{ $localeCode }}" {{ old('locale', $user->profile->locale ?? '') == $localeCode ? 'selected' : '' }}>{{ $localeName }}</option>
        @endforeach
    </select>
</div>

<!-- Submit Button -->
<div class="form-group text-right">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
