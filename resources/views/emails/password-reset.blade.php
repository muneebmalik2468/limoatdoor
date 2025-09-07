<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f6f6f6; padding: 20px; border-radius: 8px;">
        <h1 style="color: #2563eb;">Reset Your Password</h1>
        <p>Hello!</p>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        <p style="text-align: center;">
            <a href="{{ $resetUrl }}" style="display: inline-block; padding: 10px 20px; background-color: #2563eb; color: white; text-decoration: none; border-radius: 4px;">Reset Password</a>
        </p>
        <p>This password reset link will expire in {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minutes.</p>
        <p>If you did not request a password reset, no further action is required.</p>
        <p>Regards,<br>Team {{ config('app.name') }}</p>
    </div>
</body>
</html>