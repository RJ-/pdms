<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$faculty['firstname']}}!</h2>
<br/>
<p>Your registered employee id number is <b>{{$faculty['employee_id']}}</b></p>
<p>Your registered temporary password is <b>{{$faculty['password']}}</b></p>
<em>Please immediately change your password upon your first login. Thank you!</em>
</body>

</html>
