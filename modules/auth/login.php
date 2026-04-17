<?php
if(!defined( '_NhanDuc')){
    die ('Truy cap kh hop le');
}
// require_once './templates/assets/layouts/header-auth.php';
layout('header-auth');
?>
<div class="login-container">
    <h3 class="text-center mb-4" style="font-weight: 700; color: #333;">Login</h3>
<form>
  <!-- Email input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <label class="form-label" for="form2Example1">Email </label>
    <input type="email" id="form2Example1" class="form-control" />
  </div>

  <!-- Password input -->
  <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="form2Example2">Password</label>
    <input type="password" id="form2Example2" class="form-control" />
  </div>

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
        <label class="form-check-label" for="form2Example31"> Remember me </label>
      </div>
    </div>

    <div class="col">
      <!-- Simple link -->
      <a href="<?php echo _HOST_URL?>?module=auth&action=forgot">Forgot password?</a>
    </div>
  </div>

  <!-- Submit button -->
  <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Sign in</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member? <a href="<?php echo _HOST_URL?>?module=auth&action=register">Register</a></p>

  </div>
</form>
</div>