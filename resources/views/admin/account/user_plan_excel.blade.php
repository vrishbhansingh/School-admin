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
        @foreach($data as $row)
            <tr>
                <td>{{ $row['Username'] }}</td>
                <td>{{ $row['Parent'] ?? '-' }}</td>
                <td>{{ $row['Level (Rank)'] }}</td>
                <td>{{ $row['Total Investment (₹)'] }}</td>
                <td>{{ $row['Cumulative Income (₹)'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
