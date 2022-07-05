<x-auth-template :title="$title" :description="$description">
    <form id="login-form">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group flex-nowrap">
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" aria-label="password" aria-describedby="addon-wrapping">
                <span class="input-group-text" onclick="password_show_hide();">
                    <i class="uil-eye" id="show_eye"></i>
                    <i class="uil-eye-slash d-none" id="hide_eye"></i>
                </span>
            </div>
        </div>
        <div class="mb-3">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
    </form>
</x-auth-template>
