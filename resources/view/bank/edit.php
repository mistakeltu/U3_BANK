<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-5 ">
            <div class="card mt-5">
                <div class="card-header">
                    Edit account
                </div>
                <div class="card-body">
                    <form action="<?= URL . 'bank/update/' . $user['id'] ?>" method="post">
                        <h5 class="card-title">Edit user money</h5>
                        <p class="card-text">You can add or subtract money from account.</p>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstName" value="<?= $user['firstName'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastName" value="<?= $user['lastName'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Personal code</label>
                            <input type="number" class="form-control" name="personalCode" value="<?= $user['personalCode'] ?>">
                        </div>
                        <div class="mb-3">
                        </div>
                        <button type="submit" class="btn btn-primary">Edit account</button>
                        <a href="<?= URL . 'bank' ?>" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>