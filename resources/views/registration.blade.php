@if($errors->has('email'))
	<div>
		{{ $errors->first('email') }}
	</div>
@endif
@if($errors->has('password'))
	<div>
		{{ $errors->first('password') }}
	</div>
@endif
<h1>Регистрация</h1>
<form action="{{ route('user.registration') }}" method="post">
  @csrf
	<p><input name="name" placeholder="введите name" value="{{ old('name') }}"></p>
	<p><input name="email" placeholder="введите email" value="{{ old('email') }}"></p>
	<p><input name="password" placeholder="введите пароль" value="{{ old('password') }}"></p>
	<input type="submit">
</form>
<a href="{{ route('user.login') }}">Залог</a>