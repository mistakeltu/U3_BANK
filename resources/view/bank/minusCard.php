<h1>HELLO</h1>

<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-5 ">
            <div class="card mt-5">
                <div class="card-header">
                    Subtract money from account balance
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= URL . 'bank/minusFromAcc/' . $user['id'] ?>">
                        <p class="card-text">You have monye in your balance balance: <?= $user['money'] ?></p>
                        <input type="number" class="form-control" name="minus">
                        <button type="submit" class="btn btn-success">Yes</button>
                        <a href="<?= URL . 'bank' ?>" class="btn btn-danger">No</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>