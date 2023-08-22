<h1>Accounts list</h1>

<table class="table table-dark">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Account id</th>
            <th scope="col">Account Number</th>
            <th scope="col">User Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Personal Code</th>
            <th scope="col">Money</th>
            <th scope="col">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $user) : ?>
            <tr>
                <th scope="row"><?= $user['id'] ?></th>
                <td><?= $user['accNumber'] ?></td>
                <td><?= $user['firstName'] ?></td>
                <td><?= $user['lastName'] ?></td>
                <td><?= $user['personalCode'] ?></td>
                <td><?= $user['money'] ?></td>
                <td>
                    <a href="<?= URL . 'bank/delete/' . $user['id'] ?>" class="btn btn-outline-light">Delete</a>
                    <a href="<?= URL . 'bank/edit/' . $user['id'] ?>" class="btn btn-outline-light">Edit account</a>
                    <a href="<?= URL . 'bank/show/' . $user['id'] ?>" class="btn btn-outline-light">Show account info</a>
                    <a href="<?= URL . 'bank/addCard/' . $user['id'] ?>" class="btn btn-outline-light">Add money</a>
                    <a href="<?= URL . 'bank/minusCard/' . $user['id'] ?>" class="btn btn-outline-light">Subtract money</a>

                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>