<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>{{ $menuClient->user->name ?? '' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        .icon-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            padding: 15px 0;
            text-align: center;
            z-index: 1000;
        }
        
        .icon-bar a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 12px 16px;
            margin: 0 5px;
            text-decoration: none;
            font-size: 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .icon-bar a:hover {
            background-color: #000;
            transform: translateY(-3px);
        }
        
        .facebook { background-color: #3B5998; }
        .twitter { background-color: #55ACEE; }
        .google { background-color: #dd4b39; }
        .linkedin { background-color: #007bb5; }
        .tiktok { background-color: #000000; }
        .youtube { background-color: #bb0000; }
        .instagram { background-color: #125688; }
        .whatsapp { background-color: #25D366; }
        
        .tiktok svg {
            width: 20px;
            height: 20px;
            vertical-align: middle;
        }
    </style>
</head>

<body> 

    @foreach($menuClientList->categories as $category)
        <img src="{{ $category->banner ? $category->banner->getUrl() : '' }}" alt="">
    @endforeach 

    <div class="icon-bar">
        @if($menuClientList->facebook) <a href="{{ $menuClientList->facebook }}" class="facebook"><i class="fa fa-facebook"></i></a>@endif
        @if($menuClientList->twitter) <a href="{{ $menuClientList->twitter }}" class="twitter"><i class="fa fa-twitter"></i></a>@endif
        @if($menuClientList->google) <a href="{{ $menuClientList->google }}" class="google"><i class="fa fa-google"></i></a>@endif
        @if($menuClientList->linkedin) <a href="{{ $menuClientList->linkedin }}" class="linkedin"><i class="fa fa-linkedin"></i></a>@endif
        @if($menuClientList->tiktok) <a href="{{ $menuClientList->tiktok }}" class="tiktok"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg></a> @endif
        @if($menuClientList->youtube) <a href="{{ $menuClientList->youtube }}" class="youtube"><i class="fa fa-youtube"></i></a>@endif
        @if($menuClientList->instagram) <a href="{{ $menuClientList->instagram }}" class="instagram"><i class="fa fa-instagram"></i></a>@endif
        @if($menuClientList->whatsapp) <a href="{{ $menuClientList->whatsapp }}" class="whatsapp"><i class="fa fa-whatsapp"></i></a>@endif
    </div>
    
</body>

</html>
