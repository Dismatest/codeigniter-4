<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Sacco Hisa - New Message</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 24px;
            color: purple;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #666;
        }
        .footer {
            background-color: pink;
            padding: 20px;
            text-align: center;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>New Message Received from M-Zawadi sacco portal.</h1>
    <p><strong>Hello, </strong> <?= $name ?></p>
    <p>You have received this message because you have requested to change your password for the M-zawadi sacco Hisa web portal.</p>
    <p><strong>Message:</strong> <?= $message; ?></p>
    <p><strong>Thank You.</p>
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> M-Zawadi.com</p>
    </div>
</div>
</body>
</html>
