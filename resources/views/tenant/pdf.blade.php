<!DOCTYPE html>
<html>
<head>
    <title>Transaction Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; font-size: 12px; text-align: left; }
        th { background-color: #e5f4ec; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Transaction Report</h2>
        <p style="text-align:center; font-size: 14px; margin-top: -10px;">
            Tenant: <strong>{{ $tenantName }}</strong>
        </p>
    <table>
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Description</th>
                <th>Medicine Given</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->patient_name }}</td>
                <td>{{ $transaction->age }}</td>
                <td>{{ ucfirst($transaction->gender) }}</td>
                <td>{{ $transaction->description }}</td>
                <td>{{ $transaction->medicine_given }}</td>
                <td>{{ $transaction->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
