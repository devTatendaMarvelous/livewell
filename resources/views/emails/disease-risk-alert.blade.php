{{-- resources/views/emails/disease-risk-alert.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #137a2a 0%, #2fa84f 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .risk-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .risk-low { background: #d4edda; color: #155724; }
        .risk-medium { background: #fff3cd; color: #856404; }
        .risk-high { background: #f8d7da; color: #721c24; }
        .detail-row {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #137a2a;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>⚠️ Disease Risk Alert</h2>
            <p>Important information for your livestock</p>
        </div>

        <div class="content">
            <p>Dear {{ $farmer->name }},</p>

            <p>We're alerting you to a disease risk in your region that may affect your livestock.</p>

            <div class="detail-row">
                <span class="detail-label">Disease:</span> {{ $diseaseRisk->disease_name }}
            </div>

            <div class="detail-row">
                <span class="detail-label">Region:</span> {{ $diseaseRisk->region }}
            </div>

            <div class="detail-row">
                <span class="detail-label">Risk Level:</span>
                <span class="risk-badge risk-{{ $diseaseRisk->risk_level }}">
                    {{ strtoupper($diseaseRisk->risk_level) }}
                </span>
            </div>

            @if($diseaseRisk->source)
            <div class="detail-row">
                <span class="detail-label">Source:</span> {{ $diseaseRisk->source }}
            </div>
            @endif

            @if($diseaseRisk->forecast_date)
            <div class="detail-row">
                <span class="detail-label">Forecast Date:</span> {{ $diseaseRisk->forecast_date }}
            </div>
            @endif

            <p style="margin-top: 20px;">
                <strong>Recommended Actions:</strong>
            </p>
            <ul>
                <li>Monitor your livestock closely for symptoms</li>
                <li>Ensure vaccinations are up to date</li>
                <li>Contact your veterinarian if you notice any unusual behavior</li>
                <li>Implement biosecurity measures on your farm</li>
            </ul>

            <p>Stay safe and vigilant!</p>
        </div>

        <div class="footer">
            <p>This is an automated message from {{config('app.name')}} System</p>
            <p>&copy; {{ date('Y') }} {{config('app.name')}}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
