<!DOCTYPE>
<html>
<head>
    <link href="/css/tz.css" rel="stylesheet"/>
    <script src="/js/jquery-2.0.0.min.js"></script>
    <script src="/js/tz.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
  <div class="container">
      <div class="title">Введите два числа и выберете операцию</div>
      <div class="message-error"><ul></ul></div>
      <div class="result"></div>
      <form action="/calc" method="post">
          <input type="text" name="one" placeholder="Введите значение" required>
          <input type="text" name="two" placeholder="Введите значение" required>
          <input type="radio" name="operation" value="+" checked="checked">+
          <input type="radio" name="operation" value="-">-
          <input type="radio" name="operation" value="*">*
          <input type="radio" name="operation" value="/">/
          <input type="submit" value="Посчитать">
      </form>
  </div>
</body>
</html>