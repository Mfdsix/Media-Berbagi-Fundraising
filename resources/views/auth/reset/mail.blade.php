<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	*{
		font-family: 'Arial';
	}
	p{
		color: #353535;
	}
	a{
		text-decoration: none;
	}
	h5{
		font-size: 24px;
	}
	<style>
</style>
</style>
</head>
<body>

<div>
	@if($web_set->path_logo)
		<img height="80px" src="{{ getThumb(asset('storage/' . $web_set->path_logo),128,36) }}" alt="Media Berbagi">
	@else
		<img height="80px" src="{{ getThumb(asset('assets/media-berbagi/assets/images/website/logo-media-berbagi.png'),128,36) }}" alt="Media Berbagi">
	@endif
	<h5 style="font-size: 24px; margin: 0">Reset your password</h5>
	<div style="padding: 20px; border-radius: 15px; background: #E7EBF6; margin-top: 20px;">
		<b>Hi, {{ $user->name }}</b>
		<p>You are receiving this email because we received a password reset request for your account.</p>
		<br>
		<a href="{{ url('/reset-password?e='.$user->email.'&t='.$token) }}" style="background: {{$web_set->primary ?? '#077734'}}; border-radius: 10px; padding: 10px 20px; color: #fff">Reset Password</a>
	</div>

	<p>If you did not request a password reset, no further action is required.</p>
	<br>
	<p>Regards,</p>
	<p>{{envdb('APP_NAME')}}</p>
	<hr>
	<p>If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
	<a href="{{ url('/reset-password?e='.$user->email.'&t='.$token) }}">{{ url('/reset-password?e='.$user->email.'&t='.$token) }}</a>
</div>
</body>
</html>