<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-5 ">
            <div class="card mt-5">
                <div class="card-header">
                    Register
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= URL . 'register' ?>">
                        <h5 class="card-title">Register to bank</h5>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="name" class="form-control" name="name" value="<?= old('name') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="<?= old('email') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm password</label>
                            <input type="password" class="form-control" name="password2">
                        </div>
                        <!-- <div class="mb-3">
                            <label class="form-label">Personal code</label>
                            <input type="number" class="form-control" name="personalCode" value="<?= old('personalCode') ?>">
                        </div> -->
                        <button type="submit" class="btn btn-success">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>