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
  <form action="{{ route('change') }}" method="POST">
    @csrf
    <table>
      <tr>
      @foreach ($thead as $col)
        <th>{{ $col }}</th>
      @endforeach
      </tr>
      @foreach ($tokenomics as $cat => $tokenomic)
      <tr>
        @foreach ($tokenomic as $key=>$elem)
        @if ( $loop->index > 0 )
          <td data-cell="_{{$key}}-{{$tokenomic['category_id']}}">{{$elem}}</td>
        @else
          <td><a href="{{ route('user.delete', $tokenomic['category_id'])}}">{{__('Удалить')}}</a></td>
        @endif
          @endforeach

        </tr>
      @endforeach
    </table>
    <input type="submit">
  </form>
  <script src="/js/table.js"></script>

</body>
</html>