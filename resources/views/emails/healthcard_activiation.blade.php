<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
     <table style="width:700px;">
        <tr><td><img src="{{ asset('admin_assets/img/logo.png') }}" style="width: 90px; height:90px;"</td></tr>
        <tr><td>&nbsp;</td></tr><br></br>
    <tr><td>Dear {{ $name }}!</td></tr>
    <tr><td>&nbsp;</td></tr><br></br>
    <tr><td>Welcome To  Hello India Life Care.Your Health Card Account Has Been Activited Successfully!</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Now Your Can Login To Your Health Card Pannel And You can also Create Healthcard To Other User  : </td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Name:{{ $name }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Email:{{ $email }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Mobile:{{ $mobile }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Helath Card Amount:{{ $health_card_amount }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>For Any Queries, You Can Contact US At <a href="mailto:donotdistubs@gmail.com">donotdistubs@gmail.com</a></td></tr><br></br>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Thanks & Regards,</td></tr><br></br>
    <tr><td>Hello India Life Care</td></tr>
</table>

</body>
</html>
