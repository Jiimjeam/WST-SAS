<!DOCTYPE html>
<html>
<head>
    <title>Visitation Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
            color: #2F855A;
        }

        p {
            text-align: center;
            font-size: 14px;
            margin-top: 0;
            margin-bottom: 20px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 12px;
            text-align: left;
        }

        th {
            background-color: #38A169; /* Soft green */
            color: #ffffff;
            font-size: 13px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Zebra striping */
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <h2>Transaction Report</h2>
    <p>
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
            @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->patient_name }}</td>
                    <td>{{ $transaction->age }}</td>
                    <td>{{ ucfirst($transaction->gender) }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ $transaction->medicine_given }}</td>
                    <td>{{ $transaction->quantity }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No transactions available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ \Carbon\Carbon::now()->format('F d, Y H:i A') }}
    </div>
</body>
</html>
