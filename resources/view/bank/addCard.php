<h1>HELLO</h1>

<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-5 ">
            <div class="card mt-5">
                <div class="card-header">
                    Delete account
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= URL . 'bank/addToAcc/' . $user['id'] ?>">
                        <label class="form-label">Add money to bank account</label>
                        <p class="card-text">You gonna add to balance: <?= $user['money'] ?></p>
                        <input type="number" class="form-control" name="add">
                        <button type="submit" class="btn btn-success">Yes</button>
                        <a href="<?= URL . 'bank' ?>" class="btn btn-danger">No</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>