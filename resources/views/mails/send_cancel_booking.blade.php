Hello, {{ $details['name'] }}! <br><br>

I would like to inform you that your booking has been canceled. Here are the details of your canceled booking:
<br><br>

Name: {{ $details['name'] }} <br>
Reservation Type: {{ $details['reservation_type'] }} <br>
Date Start: {{ $details['date_start'] }} <br>
Date End: {{ $details['date_end'] }} <br>
Time: {{ $details['time'] }} <br>
Place of Pool: {{ $details['pool'] }} <br>
