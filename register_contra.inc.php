<?php
declare(strict_types=1);

function is_input_empty(string $username, string $password, string $email): bool {
    return empty($username) || empty($password) || empty($email);
}

function is_input_invalid(string $email): bool {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_username_taken(object $pdo, string $username): bool {
    return (bool)get_username($pdo, $username);
}

function is_email_registered(object $pdo, string $email): bool {
    return (bool)get_email($pdo, $email);
}

function create_user(object $pdo, string $password, string $username, string $email): void {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    set_user($pdo, $hashedPassword, $username, $email);
}

?>