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
	<h5 style="font-size: 24px; margin: 0">Verify your email</h5>
	<div style="padding: 20px; border-radius: 15px; background: #E7EBF6; margin-top: 20px;">
		<b>Hello!</b>
		<p>Please click the button below to verify your email address.</p>
		<br>
		<a href="{{ $url }}" style="background: {{$web_set->primary ?? '#077734'}}; border-radius: 10px; padding: 10px 20px; color: #fff">Verify Email Address</a>
	</div>

	<p>If you did not create an account, no further action is required.</p>
	<br>
	<p>Regards,</p>
	<p>{{envdb('APP_NAME')}}</p>
	<hr>
	<p>If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:</p>
	<a href="{{ $url }}">{{ $url }}</a>
</div>
</body>
</html>