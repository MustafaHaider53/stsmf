<!DOCTYPE html>
<html>
<head>
    <title>Important: Submission of Academic Results & Fee Challan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            font-size: 22px;
            margin-bottom: 20px;
        }
        p {
            color: #555555;
            font-size: 16px;
            line-height: 1.6;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            background-color: #f9f9f9;
            margin: 10px 0;
            padding: 10px;
            border-left: 4px solid #007BFF;
            border-radius: 4px;
        }
        ul li strong {
            color: #007BFF;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777777;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .motivation {
            background-color: #e8f4f8;
            padding: 15px;
            border-left: 4px solid #28a745;
            border-radius: 4px;
            margin-top: 20px;
        }
        .motivation p {
            color: #28a745;
            font-style: italic;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dear {{ $student->name }},</h1>
        <p>We are pleased to inform you that you have successfully registered with the <strong>Syedna Taher Saifuddin Memorial Foundation</strong> for financial aid. Below are your registration details:</p>
        <ul>
            <li><strong>Application Number:</strong> {{ $student->appNo }}</li>
            <li><strong>Email:</strong> {{ $student->email }}</li>
            <li><strong>Phone:</strong> {{ $student->phone }}</li>
            <li><strong>Mohallah:</strong> {{ $student->mohallah }}</li>
        </ul>
        <p><strong>Important Reminder:</strong> To continue receiving financial aid, you are required to submit the following documents by the end of the semester:</p>
        <ul>
            <li>Your academic results.</li>
            <li>Your next semester's fee challan.</li>
        </ul>
        <p><strong>Eligibility Criteria:</strong> Please note that a minimum GPA of <strong>3.2</strong> is required to remain eligible for the next semester’s financial assistance. If your GPA falls below this threshold, the financial aid for the next semester will not be granted.</p>

        <!-- Motivational Section -->
        <div class="motivation">
            <p>"Success is no accident. It is hard work, perseverance, learning, studying, sacrifice, and most of all, love for what you are doing. Keep pushing forward, and you will achieve greatness!"</p>
            <p>"Every small step you take towards your goals brings you closer to your dreams. Believe in yourself, stay focused, and never give up!"</p>
            <p>"Education is the passport to the future, for tomorrow belongs to those who prepare for it today. Strive for excellence, and the rewards will follow."</p>
        </div>

        <p>If you have any questions or need further assistance, feel free to <a href="mailto:support@syedna.com">contact us</a>. We are here to support you!</p>
        <div class="footer">
            <p>Best regards,<br>The Syedna Taher Saifuddin Memorial Foundation Team</p>
            <p><a href="https://www.syedna.com">Visit our website</a> for more details.</p>
        </div>
    </div>
</body>
</html>