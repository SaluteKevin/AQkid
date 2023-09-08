<!DOCTYPE html>
<html>
<head>
    <title>Your Email Title</title>
</head>
<body>
    <table cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f1f1;">
        <tr>
            <td align="center" style="padding: 20px;">
                <table cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td style="padding: 20px;">
                            <h1 style="color: #333333; font-family: Arial, sans-serif;">Hello, User!</h1>
                            <p style="color: #666666; font-family: Arial, sans-serif;">This is a sample email with inline styles.</p>
                            <a href="{{route('verified',['userId' => $userId])}}">Click to verified User</a>
                            <p style="color: blue;">testword</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>