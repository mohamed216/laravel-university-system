<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2c3e50; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .footer { padding: 10px; text-align: center; font-size: 12px; color: #666; }
        .status-approved { color: #27ae60; font-weight: bold; }
        .status-rejected { color: #e74c3c; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Enrollment Update</h1>
        </div>
        <div class="content">
            <p>Hello {{ $student->name }},</p>
            
            <p>Your enrollment status for <strong>{{ $course->name }}</strong> has been updated.</p>
            
            <p>Status: 
                @if($status === 'approved')
                    <span class="status-approved">APPROVED</span>
                @else
                    <span class="status-rejected">REJECTED</span>
                @endif
            </p>
            
            @if($status === 'approved')
            <p>Congratulations! You are now officially enrolled in this course.</p>
            @else
            <p>We regret to inform you that your enrollment request was not approved at this time. Please contact your administrator for more information.</p>
            @endif
            
            <p>If you have any questions, please don't hesitate to contact us.</p>
            
            <p>Best regards,<br>The University System Team</p>
        </div>
        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
