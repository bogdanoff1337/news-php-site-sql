<?php
session_start(); // початок сесії

// видаляємо змінну сесії username
unset($_SESSION['username']);

// перенаправляємо користувача на сторінку входу
header("Location: login.php");
exit();
