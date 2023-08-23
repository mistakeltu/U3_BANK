<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-5 ">
            <div class="card mt-5">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <h5 class="card-title">Login to bank</h5>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <button type="submit" class="btn btn-success">Login</button>
                        <a href="<?= URL . 'bank' ?>" class="btn btn-danger">Back to the page</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>