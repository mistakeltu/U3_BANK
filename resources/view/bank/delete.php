<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-5 ">
            <div class="card mt-5">
                <div class="card-header">
                    Delete account
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= URL . 'bank/destroy/' . $user['id'] ?>">
                        <h5 class="card-title">Do you want to delete a user?</h5>
                        <p class="card-text">You gonna delete a user: <b><?= $user['firstName'] . ' ' . $user['lastName'] ?></b></p>
                        <button type="submit" class="btn btn-danger">Yes</button>
                        <a href="<?= URL . 'bank' ?>" class="btn btn-success">No</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>