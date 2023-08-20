<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Zanabazar+Square&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL ?>main.css">
    <script src="<?= URL ?>app.js" defer></script>
    <title><?= $pageTitle ?? 'No title' ?></title>
</head>

<body>
    <div>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand">Bank</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL . 'bank' ?>">All users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL . 'bank/create' ?>">Create new user</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL . 'bank/delete' ?>">Delete user</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="nav-link" href="<?= URL . 'login' ?>">Login</a>
                </div>
            </div>
        </nav>