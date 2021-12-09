<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
  ...
  @extends('layout')
@section('content')

<form action="{{ action('FormsController@handleCreate') }}" method="post" role="form">

    {{ $form_content }}

    <input type="submit" value="Create" />
    <a href="{{ action('FormsController@index') }}">Cancel</a>
</form>
@stop
  ...
</body>
</html>
