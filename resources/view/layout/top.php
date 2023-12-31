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
    <?php require __DIR__ . '/messages.php' ?>
    <?php if (!isset($showNav) || $showNav) : ?>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand">Bank</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>">Home page</a>
                    </li>
                    <?php if (check(['admin', 'user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL . 'bank' ?>">All accounts</a>
                        </li>
                    <?php endif ?>
                    <?php if (check(['admin'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL . 'bank/create' ?>">Create new account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL . 'bank' ?>">Edit account</a>
                        </li>
                    <?php endif ?>
                    <?php if (!check(['admin', 'user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL . 'register' ?>">Register</a>
                        </li>
                    <?php endif ?>
                </ul>
                <div class="d-flex">
                    <?php if (null === $admin) : ?>
                        <a class="nav-link" href="<?= URL . 'login' ?>">Login</a>
                    <?php else : ?>
                        <form action="<?= URL . 'logout' ?>" method="post">
                            <button type="submit" class="btn btn-link nav-link"><b><?= $admin['name'] ?></b>, Logout</button>
                        </form>
                    <?php endif ?>
                </div>
            </div>
        </nav>
    <?php endif ?>