@php
defined('BASEPATH') OR exit('No direct script access allowed')
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.head')
</head>
<body class="hold-transition register-page">
@yield('content')

@include('layouts.script')
</body>
</html>
