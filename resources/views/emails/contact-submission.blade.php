<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h1 style="color: #1a73e8;">New Contact Form Submission</h1>
    <p>A user has submitted the contact form on your site. Here are the details:</p>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 8px; text-align: left; border: 1px solid #ddd;">Field</th>
            <th style="padding: 8px; text-align: left; border: 1px solid #ddd;">Details</th>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Name</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $name }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Email</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $email }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Subject</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $subject }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Message</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $userMessage }}</td>
        </tr>
    </table>
    
    <p style="font-size: 0.9em; color: #777;">This email was sent from your Limo At Door contact form.</p>
</body>
</html>