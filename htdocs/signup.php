<?php
include 'libs/load.php';
$signupError = '';

if (Session::isset('user')) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $email = trim($_POST['email_address'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if ($username === '' || $password === '' || $email === '') {
        $signupError = 'Username, email and password are required.';
    } else {
        $signupResult = User::signup($username, $password, $email, $phone);
        if ($signupResult === true) {
            header('Location: login.php?signup=success');
            exit;
        }

        $signupError = $signupResult;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php load_template('head.php'); ?>
  <body class="d-flex flex-column min-vh-100 bg-body-tertiary">
    <?php load_template('theme_button.php'); ?>
    <?php load_template('header.php'); ?>
    <?php if (!empty($signupError)): ?>
      <script>alert('<?= addslashes($signupError) ?>');</script>
    <?php endif; ?>
    <main class="container d-flex flex-grow-1 justify-content-center align-items-center py-5">
      <?php load_template('_signup.php'); ?>
    </main>
    <footer class="mt-auto">
      <?php load_template('footer.php'); ?>
    </footer>
    <script src="<?= get_config('base_path') ?>assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
