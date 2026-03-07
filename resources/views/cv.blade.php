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
        th:first-child { border-radius: 6px 0 0 0; }
        th:last-child { border-radius: 0 6px 0 0; }
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
            <span>📱 +966 558293901</span>
            <span>📧 mhmed216@gmail.com</span>
            <br>
            <span>🌐 github.com/mohamed216</span>
            <span>📍 Riyadh, KSA</span>
        </div>
    </div>

    <div class="summary">
        <p><strong>Professional Summary:</strong> Experienced Full Stack Developer with 5+ years of experience in web and mobile application development. Specialized in Laravel framework and Flutter mobile development. Proven track record of delivering scalable solutions for enterprise applications. Strong problem-solving skills with ability to work under pressure.</p>
    </div>

    <h2>🎓 Education</h2>
    <table>
        <tr>
            <th>Institution</th>
            <th>Qualification</th>
            <th>Year</th>
        </tr>
        <tr>
            <td>New Castle College, Sudan</td>
            <td>Bachelor of Science in Information Technology</td>
            <td>2017</td>
        </tr>
        <tr>
            <td>Omdurman Alahlia University, Sudan</td>
            <td>Diploma in Information Technology</td>
            <td>2013</td>
        </tr>
        <tr>
            <td>Cisco Networking Academy</td>
            <td>CCNA Certification</td>
            <td>2016</td>
        </tr>
    </table>

    <h2>💻 Technical Skills</h2>
    <div class="skills-container">
        <div class="skill-box">
            <h4>Backend Development</h4>
            <ul>
                <li>PHP / Laravel</li>
                <li>Python / Django</li>
                <li>RESTful API Development</li>
                <li>MySQL / SQL Server</li>
            </ul>
        </div>
        <div class="skill-box">
            <h4>Mobile Development</h4>
            <ul>
                <li>Flutter / Dart</li>
                <li>GetX State Management</li>
                <li>Firebase Integration</li>
                <li>Provider</li>
            </ul>
        </div>
        <div class="skill-box">
            <h4>Frontend</h4>
            <ul>
                <li>HTML5 / CSS3</li>
                <li>JavaScript</li>
                <li>Bootstrap 5</li>
                <li>Blade Templates</li>
            </ul>
        </div>
        <div class="skill-box">
            <h4>Tools & Other</h4>
            <ul>
                <li>Git / GitHub</li>
                <li>Linux Server Administration</li>
                <li>Network Administration (CCNA)</li>
                <li>Visual Studio Code</li>
            </ul>
        </div>
    </div>

    <h2>💼 Professional Experience</h2>

    <div class="job-card">
        <h3>Full Stack Developer</h3>
        <p class="job-period">2022 - Present | Freelance</p>
        <ul>
            <li>Developed and maintained multiple web applications using Laravel framework</li>
            <li>Built cross-platform mobile applications using Flutter</li>
            <li>Implemented RESTful APIs for mobile and web integration</li>
            <li>Collaborated with clients to understand requirements and deliver solutions</li>
            <li>Managed database design and optimization</li>
        </ul>
    </div>

    <div class="job-card">
        <h3>Flutter Developer</h3>
        <p class="job-period">July 2022 - October 2022 | Sands Company, KSA</p>
        <ul>
            <li>Developed complete food delivery mobile application</li>
            <li>Implemented user authentication and payment integration</li>
            <li>Built real-time features for order tracking</li>
            <li>Worked with Firebase for backend services</li>
        </ul>
    </div>

    <div class="job-card">
        <h3>Network Administrator & IT Support</h3>
        <p class="job-period">January 2014 - January 2015 | National Health Insurance Fund, Sudan</p>
        <ul>
            <li>Managed network infrastructure and IT systems</li>
            <li>Provided technical support to end users</li>
            <li>Maintained system security and backups</li>
            <li>Installed and configured hardware and software</li>
        </ul>
    </div>

    <h2>🚀 Notable Projects</h2>

    <div class="project-card">
        <h3>University Management System <span class="badge">Laravel</span></h3>
        <p>Comprehensive university management system with student enrollment, course management, attendance tracking, grading, fee management, library system, and online lecture integration. Features include multi-language support (Arabic/English), role-based access control, and administrative dashboards.</p>
    </div>

    <div class="project-card">
        <h3>HR Management System <span class="badge">Laravel</span></h3>
        <p>Employee management system with attendance tracking, leave requests, payroll calculation, and performance reviews. Includes PDF/Excel exports and multi-language support.</p>
    </div>

    <div class="project-card">
        <h3>Food Delivery Platform <span class="badge green">Flutter</span></h3>
        <p>Complete food delivery ecosystem with customer app, seller portal, rider app, and admin panel. Real-time order tracking, push notifications, and payment integration.</p>
    </div>

    <div class="project-card">
        <h3>Hospital Management System <span class="badge">Laravel</span></h3>
        <p>Healthcare management system for patient records, appointments, and medical billing.</p>
    </div>

    <div class="project-card">
        <h3>E-Commerce Platform <span class="badge">Laravel</span></h3>
        <p>Full-featured online store with shopping cart, payment gateway integration, and admin panel.</p>
    </div>

    <h2>🌐 Languages</h2>
    <table>
        <tr>
            <th>Language</th>
            <th>Proficiency</th>
        </tr>
        <tr>
            <td>Arabic</td>
            <td>Native</td>
        </tr>
        <tr>
            <td>English</td>
            <td>Intermediate</td>
        </tr>
    </table>

    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #e2e8f0; text-align: center; color: #718096; font-size: 0.9em;">
        <p>Last Updated: March 2026</p>
    </div>

</body>
</html>
