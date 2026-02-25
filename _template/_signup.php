<?php

$signup = false;
if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email_address']) and isset($_POST['phone'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email_address'];
    $phone = $_POST['phone'];
    $error = signup($username, $password, $email, $phone);
    $signup = true;
}
?>

<?php
    if ($signup) {
        if (!$error) {
            ?>
<main class="container">
    <div class="bg-light p-5 rounded mt-3">
        <h1>Signup Success</h1>
        <p class="lead">Now you can login from <a href="/login.php">here</a>.</p>

    </div>
</main>
<?php
        } else {
            ?>
<main class="container">
    <div class="bg-light p-5 rounded mt-3">
        <h1>Signup Fail</h1>
        <p class="lead">Something went wrong, <?=$error?>
        </p>
    </div>
</main>
<?php
        }
    } else {
        ?>
<main class="form-signup">
      <form method="post" action="signup.php">
        <img
          class="mb-4"
          src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg"
          alt=""
          width="72"
          height="70"
        />
        <h1 class="h3 mb-3 fw-normal">Please sign up </h1>
        <div class="form-floating">
          <input
            type="email"
            class="form-control"
            id="floatingInput"
            name="email_address"
            placeholder="name@example.com"
          />

          <label for="floatingInput">email adddress</label>
        </div>
        <div class="form-floating">
          <input
            type="password"
            class="form-control"
            id="floatingpassword"
            name="password"
            placeholder="password"
          />
          <label for="floatingpassword">Password</label>
        </div>
        
        <div class="form-floating">
          <input
            type="text"
            class="form-control"
            id="floatingusername"
            name="username"
            placeholder="User Name"
          />
          <label for="floatingusername">User Name</label>
        </div>
        <div class="form-floating">
          <input
            type="text"
            class="form-control"
            id="floatingphone"
            name="phone"
            placeholder="phone"
          />
          <label for="floatingphone">Phone</label>
        </div>
        
        <div class="form-check text-start my-3">
          <input class="form-check-input"
            type="checkbox"
            value="remember-me"
            id="checkDefault"
          />
          <label class="form-check-label" for="checkDefault">
            Remember me
          </label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">
          Sign up
        </button>
      </form>
</main> 
<?php
}
?>