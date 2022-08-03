<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/css/styles.css">
  <title>Document</title>
</head>
<body>
  <div id="wrapper">
    <div id="container">

      <x-header />

      <main>
        {{ $slot }}
      </main>

      <x-footer />

    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
  <script src="/js/chart.js"></script>
</body>
</html>