<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <a href="{{ route('user.admin') }}">Назад</a>
  <input name="baseDate" id="baseDate" value="{{$baseDate}}" hidden>
  <form action="{{ route('create') }}" method="POST">
    @csrf
    <p><input name="baseSum" id="name" value="{{$bSum}}">$</p>
    <p>
      <select name="globalPercent" id="finish">
        <option  hidden>Процент категории</option>
          @foreach ($gPercents as $per)
            <option value="{{$per}}">{{$per}}</option>
          @endforeach
      </select>
    </p>
      <p><input name="name" placeholder="Название категории" id="name"></p>
      <p><input name="adress" placeholder="Адрес"></p>
      <p><input name="raund" placeholder="Раунд"></p>

      <input type="submit">
  </form>
  <script src="/js/add.js"></script>
</body>
</html>

