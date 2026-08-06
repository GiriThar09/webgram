<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Selfmade Ninja Academy">
    <meta name="generator" content="Hugo 0.88.1">
    <title>webgram</title>
    <!-- Bootstrap core CSS -->
    <?php $base_path = get_config('base_path', '/');
    if (!$base_path) { $base_path = '/'; }
    if (substr($base_path, 0, 1) !== '/') { $base_path = '/' . $base_path; }
    if (substr($base_path, -1) !== '/') { $base_path .= '/'; }
    ?>
    <link href="<?= htmlspecialchars($base_path) ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?= htmlspecialchars($base_path) ?>assets/js/color-modes.js"></script>
    <script>
    // Initialize the agent at application startup.
    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
        .then(FingerprintJS => FingerprintJS.load())

    // Get the visitor identifier when you need it.
    fpPromise
        .then(fp => fp.get())
        .then(result => {
        // This is the visitor identifier:
        const visitorId = result.visitorId
        console.log(visitorId)
        $('#fingerprint').val(visitorId);
        })
    </script>

    <?php
    $page_css = basename($_SERVER['PHP_SELF'], '.php') . '.css';
    $app_root_css_path = dirname(__DIR__) . '/css/' . $page_css;

    if (!file_exists($app_root_css_path)) {
        $page_css = 'main.css';
    }
    ?>
    <link href="<?= htmlspecialchars($base_path) ?>css/<?= htmlspecialchars($page_css) ?>" rel="stylesheet">
</head>