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
            </tr>
        <?php endforeach ?>
    </tbody>
</table>