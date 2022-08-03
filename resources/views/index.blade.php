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
  @foreach ($percents as $elem)
  <input class="gPercents" value="{{$elem}}" hidden>

  @endforeach
  <div id="charts">
    <div id="chart1">
      <canvas id="myChart"></canvas>
    </div>
    <div id="chart2">
      <canvas id="myChart2"></canvas>
    </div>
  </div>
  <div id="info">
    <div class="info">
      <div class="title">Tokens blocked</div>

      <div class="content">250 000</div>
    </div>
    <div class="info">
      <div class="title">Circulating supply</div>

      <div class="content">{{$bSum - $sum}}</div>
    </div>
    <div class="info">
      <div class="title">Time to full unlock</div>

      <div class="content">1y:11m:4d:12s</div>
    </div>
    <div class="info">
      <div class="title">Max supply</div>

      <div class="content">{{$bSum}}</div>
    </div>
  </div>
  @include('filter')
  <table>
    <tr>
      @foreach ($thead as $col)
        <th>{{ $col }}</th>
      @endforeach
    </tr>
    @foreach ($data as $dt)
      <tr>
        @foreach ($dt as $key=>$elem)
          <td>
            @if ($key == "address")
              <a href="{{ route('address', $elem)}}" target="_blank">{{$elem}}</a>
            @else
              {{$elem}}
            @endif
          </td>
        @endforeach
      </tr>
    @endforeach
</table>
</x-layout>