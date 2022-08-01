<h1>{{$category['adress']}}</h1>
<div>{!!QrCode::encoding('UTF-8')
  ->size(250)
  ->generate("
  Название категории: $category[name]
  Аллокация: $category[allocation]
  Раунд: $category[raund]
  Месяц блока: $category[blocked]
  Месяц разлока: $category[unblocked]
  Время до разлока: $category[offTime]
")!!}

<ul>
<li>{{__('Название категории')}}: {{$category['name']}}</li>
<li>{{__('Аллокация')}}: {{$category['allocation']}}%</li>
<li>{{__('Раунд')}}: {{$category['raund']}}</li>
<li>{{__('Месяц блока')}}: {{$category['blocked']}}</li>
<li>{{__('Месяц разлока')}}: {{$category['unblocked']}}</li>
<li>{{__('Время до разлока')}}: {{$category['offTime']}} мес.</li>
</ul>
</div>