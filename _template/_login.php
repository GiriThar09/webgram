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
        <?php
        
        load_template('index.php');
        ?>
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
          src="data:image/webp;base64,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"
          alt=""
          width="72"
          height="70"
        />
        <h1 class="h3 mb-3 fw-normal"><b>log in </b></h1>
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