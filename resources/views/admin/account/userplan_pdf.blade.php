<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Plan Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>User Plan Report</h2>

    <p><strong>Total Members:</strong> {{ $totalMembers }}</p>
    <p><strong>Total Levels:</strong> {{ $totalLevels }}</p>

    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Parent</th>
                <th>Level (Rank)</th>
                <th>Total Investment (₹)</th>
                <th>Cumulative Income (₹)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row['Username'] }}</td>
                    <td>{{ $row['Parent'] ?? '-' }}</td>
                    <td>{{ $row['Level (Rank)'] }}</td>
                    <td>{{ number_format($row['Total Investment (₹)']) }}</td>
                    <td>{{ number_format($row['Cumulative Income (₹)']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
