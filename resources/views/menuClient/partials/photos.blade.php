<div class="text-center">
    <h5 style="color:black">{{ $menuProduct->name }}</h5>
    <p style="color:black"><?php echo nl2br($menuProduct->description); ?></p>
    @foreach ($menuProduct->photos as $media)
        <a href="{{ $media->getUrl() }}" target="_blanc">
            <img src="{{ $media->getUrl() }}" alt="" width="300" style="margin: 10px">
        </a>
    @endforeach
</div>
