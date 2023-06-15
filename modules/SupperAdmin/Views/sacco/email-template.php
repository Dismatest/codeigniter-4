<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>My Website - New Message</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background: #919090;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            font-size: 24px;
            color: #1bcfb4;
            border-bottom: 3px solid black;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        .footer {
            background-color: #1bcfb4;
            padding: 20px;
            text-align: center;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>A New Message Received from Sacco Hisa.</h1>
    <p class="container-header">Welcome to Sacco Hisa share capital platform.</p>
    <p><strong>Congratulations:</strong> <?= $message; ?></p>
    <p><strong>Thank You.</p>
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> Saccohisa.com, all rights observed</p>
    </div>
</div>
</body>
</html>
