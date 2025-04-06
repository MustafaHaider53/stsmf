<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remarks on Your Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1616f5;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: #4CAF50;
        }
        p {
            font-size: 1.1em;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Remarks on Your Result</h1>
        <p>Dear {{ $result->student->name }},</p>
        <p>Here are the remarks on your result for semester {{ $result->semester }}:</p>
        <h1><strong>{{ $result->remarks }}</strong></h1>
        <p>Thank you,</p>
        <p>Admin</p>
        <div class="footer">
            <p>This is an automated message, please do not reply.</p>
        </div>
    </div>
</body>
</html>