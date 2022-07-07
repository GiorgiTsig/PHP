<!DOCTYPE html>
<html lang="en">
      <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="css/index_style.css">
      <title>Sign up </title>
      </head>
<body>
<h1>Sing up</h1>
  <div id="success" class="success">
    <div>record has been saved!</div>
  </div>
<div id="alert" class="alert"></div>
<div >
        <form  method="post" enctype="multipart/form-data">
        <div class="container">
        <label for="email"><b>Email</b></label>
        <input id="email" type="email" name="email" placeholder="Enter Email">
        <label for="fname"><b>First Name</b></label>
        <input id="fname" type="text"  name="fname" placeholder="Enter First Name">
        <label for="lname"><b>Last Name</b></label>
        <input id="lname" type="text" name="lname" placeholder="Enter Last Name">
        <button id="submit" type="submit">Sign up</button>
        <a href="/users_table" type="button" class="button">Rows</a>
      </div>
  </div>
</form>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    document.getElementById('submit').addEventListener('click', function (evt) {
        evt.preventDefault()
        sendSaveRequest()
    })

    function hideSystemMessages() {
        let alertElement = $('#alert')
        alertElement.empty()
        alertElement.hide()
        $('#success').hide()
    }

    function sendSaveRequest()
    {
        hideSystemMessages()

        let email = document.getElementById('email').value
        let fname = document.getElementById('fname').value
        let lname = document.getElementById('lname').value

        $.ajax({
            type: "POST",
            url: '/save_signup_record',
            data: {'email': email, 'fname': fname, 'lname': lname},
        }).done(function (response) {
            if (response == 1) {
                $('#success').show()
            } else {
                let errors = JSON.parse(response)
                let alertElement = $('#alert')

                alertElement.show()

                for (const error of errors) {
                    let errorElement = document.createElement('div')
                    errorElement.innerText = error
                    alertElement.append(errorElement)
                }
            }
        });
    }
</script>
