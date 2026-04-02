<?php
session_start();
include_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>

<body>
    <h1>Sign Up</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label>Username</label>
        <input type="text" name="username" required><br><br>

        <label>Email Address</label>
        <input type="email" name="email" required><br><br>

        <label>Password</label>
        <input type="password" name="password" required><br><br>

        <label>Profile Image</label>
        <input type="file" name="image" accept="image/png, image/jpeg, image/jpg" required><br><br>

        <input type="submit" value="Submit"><br><br>
        <a href="login.php">Log in</a>
    </form>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // 原密码不要 escape

    if (!empty($username) && !empty($email) && !empty($password)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "$email is not a valid email.";
            exit();
        }

        $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($check_email) > 0) {
            echo "❌ Email already exists.";
            exit();
        }

        if (isset($_FILES['image'])) {
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
            $allowed_exts = ["jpeg", "jpg", "png"];
            $allowed_types = ["image/jpeg", "image/jpg", "image/png"];

            if (in_array($img_ext, $allowed_exts) && in_array($img_type, $allowed_types)) {
                $new_img_name = time() . '_' . uniqid() . '.' . $img_ext;

                if (!is_dir("images")) mkdir("images");
                if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                    $ran_id = rand(time(), 100000000);
                    $status = "Online";
                    $hashed_pass = password_hash($password, PASSWORD_DEFAULT); // ✅ 更安全

                    $insert = mysqli_query($conn, "INSERT INTO users (unique_id, username, email, password, image, status)
                        VALUES ({$ran_id}, '{$username}', '{$email}', '{$hashed_pass}', '{$new_img_name}', '{$status}')");

                    if ($insert) {
                        $_SESSION['unique_id'] = $ran_id;
                        header("Location: profile.php");
                        exit();
                    } else {
                        echo "❌ Failed to insert data.";
                    }
                } else {
                    echo "❌ Failed to upload image.";
                }
            } else {
                echo "❌ Please upload image file (jpeg, jpg, png).";
            }
        }
    } else {
        echo "❌ All input fields are required!";
    }
}
?>

</html>