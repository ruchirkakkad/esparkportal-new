<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
            Hello, {{$user->first_name}} {{$user->last_name}}
            You are successfully registered with us.<br>
            
            Your Login details are here..<br>
            Login Email:{{$user->email}}<br>
            Login Password:{{$user->password1}}<br>
		<h4>Thank you...!</h4>

	
	</body>
</html>
