<?php

$pdo = new PDO('mysql:host=localhost;dbname=signup', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT * FROM users');
$statement->execute();
$user = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users Table</title>
    <link rel="stylesheet" href="css/app.css"/>
</head>
<body>
<a href="/" type="button" class="Form">Registration Form</a>
<h1>Users</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($user as $i => $users) { ?>
        <tr id="tr-<?php echo $users['id'] ?>">
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $users['fname'] ?></td>
            <td><?php echo $users['lname'] ?></td>
            <td><?php echo $users['email'] ?></td>
            <td>
                <button value="<?php echo $users['id'] ?>" type="button" class="Delete"
                        onclick="sendDeleteRequest(this.value)">Delete
                </button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    function sendDeleteRequest(id) {
        $.ajax({
            type: 'POST',
            url: '/delete_signup_record',
            data: {'id': id}
        }).done(function () {
            $(`#tr-${id}`).remove()
        })
    }
</script>