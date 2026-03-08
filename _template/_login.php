<?php

    $username = $_POST['email_address'];
    $password = $_POST['password'];

    $result =validate_user($username,$password);
    if($result){
       ?>
<main class="container">
    <div class="bg-light p-5 rounded mt-3">
        <h1>Login Success</h1>
        <p class="lead">This example is a quick exercise to do basic login with html forms.</p>
    </div>
</main>
<?php
} 
else {
 
        ?>


<main class="form-signin">
      <form method="post" action="/app/login.php">
        <img
          class="mb-4"
          src="https://stock.adobe.com/search?k=wb+logo&asset_id=432659644"
          alt=""
          width="72"
          height="70"
        />
        <h1 class="h3 mb-3 fw-normal">log in </h1>
        <div class="form-floating">
          <input
            type="email"
            class="form-control"
            id="floatingInput"
            name="email_address"
            placeholder="name@example.com"
          />
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input
            type="password"
            class="form-control"
            id="floatingPassword"
            name="password"
            placeholder="Password"
          />
          <label for="floatingPassword">Password</label>
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
          Sign in
        </button>
      </form>
</main>

<?php
}