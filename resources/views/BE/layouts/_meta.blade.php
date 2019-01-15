<meta charset="UTF-8">
<title>
    {{@$title ? $title : 'CRM'}}
</title>

<meta name="description" content="Dashboard"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="shortcut icon" href="{{asset('BE/img/favicon.ico')}}">

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    var urlassets = '{{asset('BE')}}';
    var urlbase = location.protocol + "//" + location.host;
</script>

