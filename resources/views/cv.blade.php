<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mohamed Arabi - Full Stack Developer</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; max-width: 800px; margin: 0 auto; padding: 40px; background: white; }
        h1 { color: #1a365d; font-size: 2.2em; margin-bottom: 5px; }
        h2 { color: #1a365d; border-bottom: 2px solid #3182ce; padding-bottom: 8px; margin: 30px 0 15px 0; font-size: 1.3em; }
        h3 { color: #2d3748; margin: 15px 0 8px 0; font-size: 1.1em; }
        p { margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background-color: #3182ce; color: white; font-weight: 600; }
        .header { text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 3px solid #3182ce; }
        .contact-info { color: #4a5568; font-size: 0.95em; }
        .contact-info span { margin: 0 10px; }
        ul { margin-left: 20px; }
        li { margin: 4px 0; }
        .skills-container { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; }
        .skill-box { background: #f7fafc; padding: 15px; border-radius: 8px; border-left: 4px solid #3182ce; }
        .skill-box h4 { color: #1a365d; margin-bottom: 8px; font-size: 1em; }
        .skill-box ul { margin: 0; }
        .job-card { background: #f7fafc; padding: 20px; margin: 15px 0; border-radius: 8px; border-left: 4px solid #38a169; }
        .job-card h3 { margin-top: 0; }
        .job-period { color: #718096; font-size: 0.9em; font-style: italic; }
        .project-card { background: #fff; padding: 15px; margin: 10px 0; border-radius: 6px; border: 1px solid #e2e8f0; }
        .badge { display: inline-block; background: #3182ce; color: white; padding: 2px 10px; border-radius: 12px; font-size: 0.75em; margin-left: 8px; }
        .badge.green { background: #38a169; }
        .summary { background: #ebf8ff; padding: 20px; border-radius: 8px; margin-bottom: 25px; border-left: 4px solid #3182ce; }
        .summary p { color: #2c5282; }
        @media print { body { padding: 20px; } }
    </style>
</head>
<body>
    <div class="header">
        <h1>Mohamed Arabi</h1>
        <p style="font-size: 1.2em; color: #4a5568;">Full Stack Developer</p>
        <div class="contact-info">
            <span>+966 558293901</span>
            <span>mhmed216@gmail.com</span>
            <br>
            <span>github.com/mohamed216</span>
            <span>Riyadh, KSA</span>
        </div>
    </div>
    <div class="summary">
        <p><strong>Professional Summary:</strong> Experienced Full Stack Developer with 5+ years in web and mobile app development. Specialized in Laravel and Flutter. Delivered scalable enterprise solutions. Strong problem-solving skills.</p>
    </div>
    <h2>Education</h2>
    <table>
        <tr><th>Institution</th><th>Qualification</th><th>Year</th></tr>
        <tr><td>New Castle College</td><td>BSc Information Technology</td><td>2017</td></tr>
        <tr><td>Omdurman Alahlia University</td><td>Diploma in IT</td><td>2013</td></tr>
        <tr><td>Cisco Networking Academy</td><td>CCNA</td><td>2016</td></tr>
    </table>
    <h2>Technical Skills</h2>
    <div class="skills-container">
        <div class="skill-box">
            <h4>Backend</h4>
            <ul>
                <li>PHP / Laravel</li>
                <li>Python</li>
                <li>RESTful API</li>
                <li>MySQL</li>
            </ul>
        </div>
        <div class="skill-box">
            <h4>Mobile</h4>
            <ul>
                <li>Flutter / Dart</li>
                <li>GetX</li>
                <li>Firebase</li>
            </ul>
        </div>
        <div class="skill-box">
            <h4>AI Tools</h4>
            <ul>
                <li>ChatGPT</li>
                <li>Claude</li>
                <li>OpenAI</li>
            </ul>
        </div>
        <div class="skill-box">
            <h4>Tools</h4>
            <ul>
                <li>Git / GitHub</li>
                <li>Linux Server</li>
                <li>Network Admin (CCNA)</li>
            </ul>
        </div>
    </div>
    <h2>Experience</h2>
    <div class="job-card">
        <h3>Full Stack Developer</h3>
        <p class="job-period">2022 - Present | Freelance</p>
        <ul>
            <li>Developed web apps with Laravel</li>
            <li>Built mobile apps with Flutter</li>
            <li>Implemented RESTful APIs</li>
            <li>Database design and optimization</li>
        </ul>
    </div>
    <div class="job-card">
        <h3>Flutter Developer</h3>
        <p class="job-period">2022 | Sands Company, KSA</p>
        <ul>
            <li>Built food delivery app</li>
            <li>Firebase integration</li>
        </ul>
    </div>
    <h2>Projects</h2>
    <div class="project-card"><h3>University Management System <span class="badge">Laravel</span></h3><p>Student enrollment, courses, attendance, grades, fees, library, online lectures. Multi-language (Arabic/English).</p></div>
    <div class="project-card"><h3>HR Management System <span class="badge">Laravel</span></h3><p>Employee management, attendance, leave requests, payroll.</p></div>
    <div class="project-card"><h3>Food Delivery Platform <span class="badge green">Flutter</span></h3><p>Customer, seller, rider apps + admin panel.</p></div>
    <h2>Languages</h2>
    <table><tr><td>Arabic</td><td>Native</td></tr><tr><td>English</td><td>Intermediate</td></tr></table>
    <div style="margin-top:40px;text-align:center;color:#718096;font-size:0.9em"><p>Last Updated: March 2026</p></div>
</body>
</html>
