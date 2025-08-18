<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>{{ $menuClient->user->name ?? '' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />  
</head>

<body> 

    @foreach($menuClientList->categories as $category)
        <img src="{{ $category->banner ? $category->banner->getUrl() : '' }}" alt="">
    @endforeach 
</body>

</html>
