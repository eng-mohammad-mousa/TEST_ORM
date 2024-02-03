<div class="conttt">
    <label for="password">Password</label>
    <br>
    <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required
        autocomplete="current-password">

    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
