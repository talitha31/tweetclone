<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TC - Twitter Clone</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?= link_tag('css/bootstrap.min.css') ?>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-ligt" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= base_url() ?>">
                    <?= img(['src' => 'images/twitter_logo.png', 'width' => 30, 'height' => 24]) ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <strong><a class="nav-link" href="<?= base_url('/') ?>">(TC) Twitter Clone</a></strong>
                        <a class="nav-link" href="<?= base_url('/auth') ?>">Login</a>
                        <a class="nav-link" href="<?= base_url('/register') ?>">Register</a>
                    </div>
                </div>
        </nav>