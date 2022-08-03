<x-layout>
  <h1>{{$data['address']}}</h1>
  {{-- <div>{!!QrCode::encoding('UTF-8')
    ->size(250)
    ->generate("
    Название категории: $category[name]
    Аллокация: $category[allocation]
    Раунд: $category[raund]
    Месяц блока: $category[blocked]
    Месяц разлока: $category[unblocked]
    Время до разлока: $category[offTime]
  ")!!} --}}
  <div id="block">
    <div id="qr">{{QrCode::encoding('UTF-8')
      ->size(200)
      ->generate("http://www.cw62555.tmweb.ru/address/$data[address]")}}
    </div>
    <div id="info2">
        <div class="info2">
        <div class="info2-one">
          <div class="title2">Blocked tokens</div>
          <div class="content2">{{$data['blocked']}}</div>
        </div>
        <div class="info2-one">
          <div class="title2">Unlocked tokens</div>
          <div class="content2">{{$data['unlocked']}}</div>
        </div>
        </div>
        <div class="info2">
        <div class="info2-one">
          <div class="title2">Round</div>
          <div class="content2">Seep</div>
        </div>
        <div class="info2-one">
          <div class="title2">Time to unlock</div>
          <div class="content2">1y:11m:4d:12s</div>
        </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>

{{-- <ul>
<li>{{__('Название категории')}}: {{$category['name']}}</li>
<li>{{__('Аллокация')}}: {{$category['allocation']}}%</li>
<li>{{__('Раунд')}}: {{$category['raund']}}</li>
<li>{{__('Месяц блока')}}: {{$category['blocked']}}</li>
<li>{{__('Месяц разлока')}}: {{$category['unblocked']}}</li>
<li>{{__('Время до разлока')}}: {{$category['offTime']}} мес.</li>
</ul> --}}