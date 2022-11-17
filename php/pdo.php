<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=php_javascript_auth', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);