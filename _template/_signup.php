<main class="container d-flex flex-grow-1 justify-content-center align-items-center py-5">
  <div class="row justify-content-center w-100">
    <div class="col-lg-5 col-md-7">
      <form method="post" action="signup.php" class="form-signup mx-auto">
        <img
          class="mb-4"
          src="/logo/logo.png"
          alt="App logo"
          width="72"
          height="70"
        />
        <h1 class="h3 mb-3 fw-normal text-center"><b>Please sign up</b></h1>

        <div class="form-floating mb-2">
          <input
            type="email"
            class="form-control"
            id="floatingInput"
            name="email_address"
            placeholder="name@example.com"
            required
          />
          <label for="floatingInput">Email address</label>
        </div>

        <div class="form-floating mb-2">
          <input
            type="password"
            class="form-control"
            id="floatingPassword"
            name="password"
            placeholder="Password"
            required
          />
          <label for="floatingPassword">Password</label>
        </div>

        <div class="form-floating mb-2">
          <input
            type="text"
            class="form-control"
            id="floatingUsername"
            name="username"
            placeholder="User Name"
            required
          />
          <label for="floatingUsername">User Name</label>
        </div>

        <div class="form-floating mb-3">
          <input
            type="text"
            class="form-control"
            id="floatingPhone"
            name="phone"
            placeholder="Phone"
          />
          <label for="floatingPhone">Phone</label>
        </div>

        <div class="form-check text-start my-3">
          <input class="form-check-input" type="checkbox" value="remember-me" id="checkDefault" />
          <label class="form-check-label" for="checkDefault">Remember me</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
      </form>
    </div>
  </div>
</main>
