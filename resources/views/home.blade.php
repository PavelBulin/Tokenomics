<x-layout>
  <input id="size" value="{{$size}}" hidden>

  @foreach ($tokenomics as $index => $tokenomic)
  <input class="catNames" value="{{ $catNames[$index] }}" hidden>
    @foreach ($tokenomic as $key=>$elem)
      @if ($index == 0)
        <input class="lables" value="{{$key}}" hidden>
        @endif
        <input class="data_{{$index}}" value="{{$elem}}" hidden>
        @endforeach

        @endforeach

        <canvas id="myChart"></canvas>
        <canvas id="myChart2"></canvas>

        <p>Общая сумма: {{$bSum}}$</p>
        <p>Общее кол-во токенов: {{$gQtyOfCats}}</p>
        <p>Кол-во заблокированных токенов: {{$locks}}</p>
        <p>{{$maxTime}} мес. до разлока последнего токена</p>

        @include('filter')
        <table>
          <tr>
            @foreach ($thead as $col)
            <th>{{ $col }}</th>
            @endforeach
          </tr>
          @foreach ($categories as $cat => $category)
          <tr>
            @foreach ($category as $key=>$elem)
            <td>
              @if ($key == "adress")
              <a href="{{ route('address', $elem)}}" target="_blank">{{$elem}}</a>
              @else
                {{$elem}}
              @endif
              @if ($key == "globalPercent")
                <input class="gPercents" value="{{$elem}}" hidden>
              @endif
          </td>

          @endforeach

        </tr>
      @endforeach
    </table>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
    <script src="/js/chart.js"></script>
</x-layout>