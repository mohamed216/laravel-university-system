<!DOCTYPE html>
<html>
<head>
    <title>Enrollment Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #2c3e50; color: white; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Enrollment Report</h1>
        <p>Generated on {{ date('Y-m-d H:i:s') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Course</th>
                <th>Status</th>
                <th>Enrollment Date</th>
                <th>Approved Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $enrollment)
            <tr>
                <td>{{ $enrollment->id }}</td>
                <td>{{ $enrollment->student?->name }}</td>
                <td>{{ $enrollment->course?->name }}</td>
                <td>{{ ucfirst($enrollment->status) }}</td>
                <td>{{ $enrollment->enrollment_date }}</td>
                <td>{{ $enrollment->approved_date ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
