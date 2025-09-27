<!DOCTYPE html>
<html>
<head>
    <title>New Booking Notification</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h1 style="color: #1a73e8;">New Booking Created</h1>
    <p>A new booking has been made. Here are the details:</p>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 8px; text-align: left; border: 1px solid #ddd;">Field</th>
            <th style="padding: 8px; text-align: left; border: 1px solid #ddd;">Details</th>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Booking ID</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $booking->id }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">User/Guest</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $booking->user ? $booking->user->name : $booking->guest_email ?? 'Anonymous' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Pickup Location</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $booking->pickup_location }} at {{ $booking->pickup_datetime->format('M d, Y H:i') }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Dropoff Location</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $booking->dropoff_location }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Contact No</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $booking->phone }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Vehicle</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $booking->vehicle->name ?? 'N/A' }} x {{$booking->vehicle_count}}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Passengers/Luggage</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $booking->passengers }} / {{ $booking->luggage }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Travel Type</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $booking->trip_type ? 'Point to Point' : 'Hourly' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Fare</td>
            <td style="padding: 8px; border: 1px solid #ddd;">${{ $booking->price ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Notes</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $booking->notes ?? 'None' }}</td>
        </tr>
    </table>
    
    <p style="font-size: 0.9em; color: #777;">This email was sent from Limo At Door system.</p>
</body>
</html>