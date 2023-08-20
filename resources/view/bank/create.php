<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-5 ">
            <div class="card mt-5">
                <div class="card-header">
                    Add account
                </div>
                <div class="card-body">
                    <form action="<?= URL . 'bank/store' ?>" method="post">
                        <h5 class="card-title">Do you want to create new bank user</h5>
                        <p class="card-text">New bank user will be with zero money</p>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Personal code</label>
                            <input type="number" class="form-control" name="personalCode">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="<?= URL . 'bank' ?>" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>