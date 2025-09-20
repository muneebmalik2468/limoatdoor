<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f6f6f6; padding: 20px; border-radius: 8px;">
        <h1 style="color: #2563eb;">Verify Your Email</h1>
        <p>Hello{{ isset($user->name) ? ' ' . $user->name : '' }}!</p>
        <p>Please verify your email address by clicking the button below:</p>
        <p style="text-align: center;">
            <a href="{{ $verificationUrl }}" style="display: inline-block; padding: 10px 20px; background-color: #2563eb; color: white; text-decoration: none; border-radius: 4px;">Verify Email</a>
        </p>
        <p>If you did not create an account, no further action is required.</p>
        <p>Regards,<br>Team {{ config('app.name') }}</p>
    </div>
</body>
</html>
