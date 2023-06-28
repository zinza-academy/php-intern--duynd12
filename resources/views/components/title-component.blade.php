<div class="flex aligns-center w-full h-20 justify-between py-3 px-3" style="">
    <h1 class="text-base font-bold" style="color:#0000000;line-height:80px">{{ $name }} Management</h1>
    <button class="mr-2 rounded" style="background-color:#3CA3DD;height:40px;width:125px;margin-top:15px">
        <a href="{{ route($name . '.create') }}" class="text-sm" style="color:white">New {{ $name }}</a>
    </button>
</div>
