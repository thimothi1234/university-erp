<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Application Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; color:#333;">
    <h2 style="color:#004080;">Dear {{ $application->name }},</h2>

    <p>Thank you for submitting your <strong>Internal Promotion Application</strong>.</p>

    <p>Your application has been successfully received on 
       <strong>{{ \Carbon\Carbon::parse($application->created_at)->format('d M Y, h:i A') }}</strong>.</p>

    <p><strong>Application ID:</strong> {{ $application->id }}</p>
    <p><strong>Department:</strong> {{ $application->department }}</p>
    <p><strong>Post Applied:</strong> {{ $application->post }}</p>

    <p>You can log in to your account anytime to review your application details.</p>

    <br>
    <p>Best regards,<br>
    <strong>Dean faculty office</strong><br>
    IIT Hyderabad</p>
</body>
</html>
