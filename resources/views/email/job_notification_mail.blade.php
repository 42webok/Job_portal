<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Notification</title>
</head>
<body>

    <h3>Hello {{ $mail_data['owner_name'] }}</h3>
    <p>You have received a new job application for the position: {{ $mail_data['job_title'] }}</p>
    <p>Applicant Details:</p>
    <ul>
        <li>Name: {{ $mail_data['applicant_name'] }}</li>
        <li>Email: {{ $mail_data['applicant_email'] }}</li>
        <li>Phone: {{ $mail_data['applicant_phone'] }}</li>
    </ul>

</body>
</html>