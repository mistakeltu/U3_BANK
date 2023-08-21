<h1>SUP</h1>
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-5 ">
            <div class="card mt-5">
                <div class="card-header">
                    Account <?= $user['id'] ?> details
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= URL . 'bank/destroy/' . $user['id'] ?>">
                        <h6 class="card-title">User first name: <?= $user['firstName'] ?></h6>
                        <h6 class="card-title">User last name: <?= $user['lastName'] ?></h6>
                        <h6 class="card-title">User personal code: <?= $user['personalCode'] ?></h6>
                        <h6 class="card-title">User bank account number: <?= $user['accNumber'] ?></h6>
                        <h5 class="card-title">User: <?= $user['firstName'] ?> has: <?= $user['money'] ?> in bank account</h5>
                        <a href="<?= URL . 'bank' ?>" class="btn btn-success">Go, back!</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>