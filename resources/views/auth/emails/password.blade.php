<h1>SEOPlus</h1>
<p>Click here to reset your password: <br><br><a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a></p>
