<?php
session_start();
include 'config.php';

$unique_id = $_SESSION['unique_id'] ?? null;

if (!$unique_id) {
    die("User not logged in.");
}

if (!is_dir('data')) {
    mkdir('data', 0777, true);
}

$action = $_POST['action'] ?? '';

if ($action === 'save_about') {
    $aboutme = $_POST['aboutme'] ?? '';
    file_put_contents('./data/aboutme.txt', $aboutme);
    header("Location: Profile.php");
    exit();
}

if ($action === 'save_note') {
    $note = $_POST['note'] ?? '';
    file_put_contents('./data/note.txt', $note);
    header("Location: Profile.php");
    exit();
}

if ($action === 'save_account') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($email)) {
        die("Username and email cannot be empty.");
    }

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE unique_id = ?");
        $stmt->bind_param("sssi", $username, $email, $hashedPassword, $unique_id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE unique_id = ?");
        $stmt->bind_param("ssi", $username, $email, $unique_id);
    }

    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: Profile.php");
        exit();
    } else {
        echo "Update failed: " . $stmt->error;
    }
}

?>