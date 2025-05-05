<?php
include "connect.php";

if($_GET['key'] && $_GET['reset']) {
  $email = $_GET['key'];
  $pass = $_GET['reset'];
  $query = "SELECT email, pass FROM user WHERE email='$email' AND pass='$pass'";
  $data = mysqli_query($conn, $query);

  if ($data == true) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <style>
    body {
      background: #f0f2f5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .reset-box {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 300px;
      text-align: center;
    }

    .reset-box h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .reset-box input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .reset-box input[type="submit"] {
      background: #007BFF;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .reset-box input[type="submit"]:hover {
      background: #0056b3;
    }

    .note {
      font-size: 0.9em;
      color: #666;
    }
  </style>
</head>
<body>
  <div class="reset-box">
    <h2>Reset Your Password</h2>
    <form method="post" action="submit_new.php">
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
      <input type="password" name="password" placeholder="Enter new password" required>
      <input type="submit" name="submit_password" value="Update Password">
    </form>
    <p class="note">Make sure your new password is strong.</p>
  </div>
</body>
</html>
<?php
  }
}
?>
