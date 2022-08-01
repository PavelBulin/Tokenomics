@if($errors->has('email'))
	<div>
		{{ $errors->first('email') }}
	</div>
@endif

<h1>Вход</h1>
<form action="{{ route('user.login') }}" method="post">
  @csrf
	<p><input name="email" placeholder="введите email" value="{{ old('email') }}"></p>
	<p><input name="password" placeholder="введите пароль" value="{{ old('password') }}"></p>

  <a class="google" href="{{ route('auth.google') }}">Войти через Google</a>
	<input type="submit">
</form>
<a href="{{ route('user.registration') }}">Зарег</a>