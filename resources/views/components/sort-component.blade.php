<form action="" method="GET">
    @if ($param == \App\Constants\StatusConstants::DESC)
        <input name={{ $name }} value="{{ \App\Constants\StatusConstants::ASC }}" hidden />
        <button type="submit">
            <img type="submit" style="height: 16px;width:16px;margin-left:10px" src="{{ URL::asset('images/down.png') }}"
                alt="">
        </button>
    @else
        <input name={{ $name }} value="{{ \App\Constants\StatusConstants::DESC }}" hidden />
        <button type="submit">
            <img type="submit" style="height: 16px;width:16px;margin-left:10px"
                src="{{ URL::asset('images/up-arrow.png') }}" alt="">
        </button>
    @endif
</form>
