<x-layout>
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
</x-layout>
