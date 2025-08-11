<?php
// Define variables and initialize with empty values
$name = $email = $message = "";
$name_err = $email_err = $message_err = $send_success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    // Validate Email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    // Validate Message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter a message.";
    } else {
        $message = htmlspecialchars(trim($_POST["message"]));
    }

    // If no errors, send email
    if (empty($name_err) && empty($email_err) && empty($message_err)) {
        $to = "your-email@example.com";  // Change to your email address
        $subject = "Contact Form Submission from $name";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $send_success = "Thank you for contacting us, $name! We'll get back to you soon.";
            // Clear form fields
            $name = $email = $message = "";
        } else {
            $send_success = "Sorry, there was an error sending your message. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Contact Us</title>
<style>
  * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(to right, #eef2f3, #8e9eab);
  padding: 40px 20px;
  color: #333;
}

.container {
  max-width: 500px;
  margin: auto;
  background: #ffffff;
  padding: 30px 25px;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  margin-bottom: 25px;
  font-size: 1.8rem;
  color: #2c3e50;
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: #444;
}

input[type="text"],
input[type="email"],
textarea {
  width: 100%;
  padding: 12px 14px;
  margin-bottom: 18px;
  border: 1px solid #ccd1d9;
  border-radius: 8px;
  font-size: 1rem;
  transition: border 0.3s, box-shadow 0.3s;
  background-color: #f9f9f9;
}

input:focus,
textarea:focus {
  outline: none;
  border-color: #3498db;
  box-shadow: 0 0 5px rgba(52, 152, 219, 0.2);
  background-color: #fff;
}

textarea {
  resize: vertical;
  min-height: 120px;
}

.error {
  color: #e74c3c;
  font-size: 0.9rem;
  margin-bottom: 12px;
}

.success {
  color: #27ae60;
  text-align: center;
  margin-bottom: 15px;
  font-weight: bold;
}

button {
  background: linear-gradient(to right, #e74c3c, #c0392b);
  color: white;
  border: none;
  padding: 14px;
  width: 100%;
  font-size: 1.1rem;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold;
  transition: background 0.3s ease;
}

button:hover {
  background: linear-gradient(to right, #c0392b, #96281b);
}

</style>
</head>
<body>

<div class="container">
  <h2>Contact Us</h2>

  <?php if (!empty($send_success)): ?>
    <p class="success"><?php echo $send_success; ?></p>
  <?php endif; ?>

  <form action="" method="post" novalidate>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>">
    <?php if ($name_err): ?><p class="error"><?php echo $name_err; ?></p><?php endif; ?>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>">
    <?php if ($email_err): ?><p class="error"><?php echo $email_err; ?></p><?php endif; ?>

    <label for="message">Message</label>
    <textarea name="message" id="message"><?php echo htmlspecialchars($message); ?></textarea>
    <?php if ($message_err): ?><p class="error"><?php echo $message_err; ?></p><?php endif; ?>

    <button type="submit">Send Message</button>
  </form>
</div>

</body>
</html>
