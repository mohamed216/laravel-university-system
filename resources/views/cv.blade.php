<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mohamed Arabi - Curriculum Vitae</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; max-width: 800px; margin: 0 auto; padding: 20px; }
        h1 { color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 10px; margin-bottom: 20px; }
        h2 { color: #2c3e50; border-left: 4px solid #3498db; padding-left: 10px; margin: 25px 0 15px 0; }
        h3 { color: #34495e; margin: 20px 0 10px 0; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #3498db; color: white; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { font-size: 2.5em; border: none; }
        .contact-info { color: #666; font-size: 0.9em; }
        ul { margin-left: 20px; }
        li { margin: 5px 0; }
        .skills-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; }
        .skill-category { background: #f8f9fa; padding: 15px; border-radius: 8px; }
        .skill-category h4 { color: #2c3e50; margin-bottom: 10px; }
        .project { background: #f8f9fa; padding: 15px; margin: 10px 0; border-radius: 8px; border-left: 4px solid #3498db; }
        .badge { display: inline-block; background: #3498db; color: white; padding: 3px 10px; border-radius: 15px; font-size: 0.8em; margin-right: 5px; }
        @media print { body { padding: 0; } }
    </style>
</head>
<body>
    <div class="header">
        <h1>Mohamed Arabi</h1>
        <div class="contact-info">
            <p>📱 +966 558293901 | 📧 mhmed216@gmail.com</p>
            <p>🌐 github.com/mohamed216 | 📍 Riyadh, KSA</p>
        </div>
    </div>

    <h2>👤 Personal Details</h2>
    <table>
        <tr><th>Field</th><th>Details</th></tr>
        <tr><td>Name</td><td>Mohamed Arabi</td></tr>
        <tr><td>Gender</td><td>Male</td></tr>
        <tr><td>Nationality</td><td>Sudan (Riyadh, KSA)</td></tr>
        <tr><td>Languages</td><td>English, Arabic</td></tr>
    </table>

    <h2>🎓 Education</h2>
    <table>
        <tr><th>University</th><th>Degree</th><th>Period</th></tr>
        <tr><td>Omdurman Alahlia University</td><td>Diploma in Information Technology</td><td>2010 - 2013</td></tr>
        <tr><td>New Castle College</td><td>Bachelor in Information Technology</td><td>2015 - 2017</td></tr>
        <tr><td>CCNA</td><td>Cisco Certified Network Associate</td><td>2016</td></tr>
    </table>

    <h2>💻 Technical Skills</h2>
    <div class="skills-grid">
        <div class="skill-category">
            <h4>Backend</h4>
            <ul>
                <li>PHP, Laravel</li>
                <li>Python</li>
                <li>ASP.NET</li>
                <li>REST API</li>
            </ul>
        </div>
        <div class="skill-category">
            <h4>Mobile</h4>
            <ul>
                <li>Flutter</li>
                <li>Dart</li>
                <li>GetX</li>
                <li>Firebase</li>
            </ul>
        </div>
        <div class="skill-category">
            <h4>Database</h4>
            <ul>
                <li>MySQL</li>
                <li>SQL Server</li>
                <li>SQLite</li>
                <li>Firebase Firestore</li>
            </ul>
        </div>
        <div class="skill-category">
            <h4>Tools</h4>
            <ul>
                <li>Git/GitHub</li>
                <li>Linux Server</li>
                <li>Network Admin (CCNA)</li>
                <li>Visual Studio Code</li>
            </ul>
        </div>
    </div>

    <h2>💼 Employment History</h2>
    
    <div class="project">
        <h3>National Health Insurance Fund (Sudan)</h3>
        <p><strong>Position:</strong> Network Admin & IT Support Engineer</p>
        <p><strong>Period:</strong> January 2014 - January 2015</p>
        <ul>
            <li>Network infrastructure maintenance</li>
            <li>System administration</li>
            <li>Technical support</li>
            <li>User account management</li>
        </ul>
    </div>

    <div class="project">
        <h3>Sands Company (KSA)</h3>
        <p><strong>Position:</strong> Flutter Developer</p>
        <p><strong>Period:</strong> July 2022 - October 2022</p>
        <ul>
            <li>Mobile app development with Flutter</li>
            <li>Food delivery app development</li>
        </ul>
    </div>

    <h2>🚀 Projects</h2>

    <h3>Mobile Applications (Flutter)</h3>
    <table>
        <tr><th>Project</th><th>Description</th></tr>
        <tr><td>Food-App-Flutter</td><td>Customer food delivery app</td></tr>
        <tr><td>Food-App-Sellers</td><td>Seller portal app</td></tr>
        <tr><td>Food-App-Riders</td><td>Delivery rider app</td></tr>
        <tr><td>Food-App-Admin</td><td>Admin web portal</td></tr>
    </table>

    <h3>Web Applications (Laravel)</h3>
    <table>
        <tr><th>Project</th><th>Description</th><th>Status</th></tr>
        <tr><td>University Management System</td><td>Full university management with students, professors, courses, attendance, grades, fees, library, online lectures</td><td><span class="badge">Complete</span></td></tr>
        <tr><td>HR Management System</td><td>Employee management with attendance, leave requests, payroll</td><td><span class="badge">Complete</span></td></tr>
        <tr><td>Real Estate Website</td><td>Property listing and management</td><td><span class="badge">Complete</span></td></tr>
        <tr><td>E-commerce Website</td><td>Full shopping cart and payment</td><td><span class="badge">Complete</span></td></tr>
        <tr><td>Hospital Management System</td><td>Patient and medical records management</td><td><span class="badge">Complete</span></td></tr>
    </table>

    <h3>Key Features Implemented</h3>
    <ul>
        <li>👥 User Authentication & Authorization (Roles: Admin, HR, Employee)</li>
        <li>📊 Admin Dashboard with Charts</li>
        <li>📧 Email Notifications</li>
        <li>📄 PDF/Excel Reports</li>
        <li>📱 REST API (Laravel Sanctum)</li>
        <li>🌐 Multi-language Support (Arabic/English)</li>
        <li>📅 Academic Calendar</li>
        <li>📹 Online Lectures (Zoom/Google Meet integration)</li>
        <li>📚 Library Management System</li>
    </ul>

    <h2>🌐 Online Profiles</h2>
    <ul>
        <li><strong>GitHub:</strong> https://github.com/mohamed216</li>
    </ul>

    <hr style="margin-top: 30px; border: none; border-top: 1px solid #ddd;">
    <p style="text-align: center; color: #666; font-size: 0.9em; margin-top: 20px;">
        Last Updated: March 2026
    </p>
</body>
</html>
