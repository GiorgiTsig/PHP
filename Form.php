<?php

class Form
{
    public function create()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=signup','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];

        $err = $this->validate();

        if (empty($err)) {
            $statement = $pdo->prepare("INSERT INTO users (email, fname, lname) VALUES (:email, :fname, :lname)");
            $statement->bindValue(':email', $email);
            $statement->bindValue(':fname', $fname);
            $statement->bindValue(':lname', $lname);
            $statement->execute();
        }

        return $err;
    }

    public function delete()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=signup','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST['id'] ?? null;

        $statement = $pdo->prepare('DELETE FROM users WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    public function validate()
    {
        $err = [];

        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];

        if (!$email) {
            $err[] = 'Email is missing';
        }

        if (!$fname) {
            $err[] = 'First name is missing';
        }

        if (!$lname) {
            $err[] = 'Last name is missing';
        }

        return $err;
    }
}
