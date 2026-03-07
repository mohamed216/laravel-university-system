<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2c3e50; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .footer { padding: 10px; text-align: center; font-size: 12px; color: #666; }
        .grade { font-size: 32px; font-weight: bold; color: #3498db; }
        .details { background: white; padding: 15px; margin: 15px 0; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Grade Posted</h1>
        </div>
        <div class="content">
            <p>Hello {{ $student->name }},</p>
            
            <p>Your grade for <strong>{{ $course->name }}</strong> has been posted.</p>
            
            <div class="details">
                <p><strong>Grade Details:</strong></p>
                <p>Course: {{ $course->name }}</p>
                <p>Grade: <span class="grade">{{ $grade->grade }}</span></p>
                <p>Score: {{ $grade->score }}</p>
                @if($grade->comments)
                <p>Comments: {{ $grade->comments }}</p>
                @endif
            </div>
            
            <p>You can view your complete academic record by logging into the student portal.</p>
            
            <p>If you have any questions about your grade, please contact your instructor.</p>
            
            <p>Best regards,<br>The University System Team</p>
        </div>
        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
