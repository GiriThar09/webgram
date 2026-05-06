<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Selfmade Ninja Academy">
    <meta name="generator" content="Hugo 0.88.1">
    <title>webgram</title>
    <!-- Bootstrap core CSS -->
    <link href="<?=get_config('base_path')?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

    <? if (file_exists($_SERVER['DOCUMENT_ROOT'] .get_config('base_path').'css/' . basename($_SERVER['PHP_SELF'], ".php") . ".css")) { ?>
        <link href="<?=get_config('base_path')?>css/<?= basename($_SERVER['PHP_SELF'], ".php") ?>.css" rel="stylesheet">
    <? } ?>
</head>