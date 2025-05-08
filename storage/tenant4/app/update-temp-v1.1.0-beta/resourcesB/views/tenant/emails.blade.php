<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Platform</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f7fa; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 20px;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 40px;">
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <h1 style="color: #333333; font-size: 28px;">Welcome, {{ $tenant->name }}!</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #555555; font-size: 16px; line-height: 1.6;">
                            <p>Your tenant account has been <strong>approved</strong>. We're excited to have you on board!</p>

                            <p><strong>Your login details are:</strong></p>
                            <ul style="padding-left: 20px;">
                                <li><strong>Email:</strong> {{ $tenant->email }}</li>
                                <li><strong>Password:</strong> {{ $password }}</li>
                            </ul>

                            <p style="margin: 30px 0;">
                                <a href="{{ $loginUrl }}" style="background-color: #4CAF50; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; display: inline-block;">
                                    Log In Now
                                </a>
                            </p>

                            <p>For your security, please change your password after your first login.</p>

                            <p style="margin-top: 40px;">Thank you,<br><strong>The Admin Team</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px; color: #999999; text-align: center; padding-top: 30px;">
                            &copy; {{ date('Y') }} Our Platform. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
