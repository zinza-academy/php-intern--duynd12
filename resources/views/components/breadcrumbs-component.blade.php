<ul>
    @foreach ($array as $key => $value)
        <a href="" style="color:blue">
                {{$value}}
        </a>
        @if (count($array) - 1 !== $key)
                >    
        @endif
    @endforeach
</ul>