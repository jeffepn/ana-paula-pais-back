<!doctype html>
<html class="h-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-149377768-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-149377768-1');
    </script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="charset" content="UTF-8">

    <link rel="canonical" href="{{request()->url()}}" />
    @section('description')
    <meta name="description"
        content="Casas, Apartamentos, Salas, Pontos Comerciais em Poços de Caldas. Entre em contato e lhe ajudaremos a encontrar o imóvel perfeito para suas necessidades.">
    @show
    <title> @section('title') {{config('app.name')}} @show em Poços de Caldas</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Hepta+Slab|Oswald:200,400|Cinzel&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    @section('css')
    @show
    <link rel="stylesheet" href="{{url('css/materialdesignicons-light.min.css')}}">
    <link rel="stylesheet" href="{{url('css/all.css?v=1.0.18')}}">
    <link rel="stylesheet" href="{{url('css/assetsutilities.min.css?v=1.0.18')}}">

</head>

<body class="h-100">
    @section('header')
    @include('parts.header')
    @show
    @section('context')
    @show
    @section('footer')
    @include('parts.footer')
    @show

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <script src="{{url('js/clipboard.min.js?v=1.0.18')}}">
    </script>
    <script src="{{url('js/assetsutilities.min.js?v=1.0.18')}}">
    </script>
    <script src="{{url('js/screen.js?v=1.0.18')}}">
    </script>
    @section('js')
    @show

    <script type="text/javascript">
        $(document).ready(function () {
            @section('js-util')
            @show
        });
    </script>
</body>

</html>
