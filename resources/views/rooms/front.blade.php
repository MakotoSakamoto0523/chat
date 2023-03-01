<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ルーム一覧画面</title>
        
    </head>

    <x-app-layout>
        <body class="bg-purple-600">
            <div class="search">
                <form action="/" method="get">
                    @csrf
                    <div class="pt-20 pl-44">
                        <input class="border-purple-500 focus:ring-purple-500 focus:ring-white-500 focus:outline-none appearance-none  text-sm leading-6 text-slate-900 placeholder-slate-400 rounded-md py-2 pl-10 ring-1 ring-slate-200 shadow-sm" name="keyword" type="text" placeholder="タイトルやチーム名で探す" value="{{ $keyword }}">
                        <input class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border-2 border-purple-200 font-semibold text-purple-500 hover:text-violet-100 hover:bg-purple-500 hover:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800" type="submit" value="検索">
                    </div>
                </form>
            </div>
            <div>
                <div class="py-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            @if( $roomsCount == 0)
                                <h1 class="pt-10 pr-10 text-center text-4xl text-gray-400">ルームはまだありません</h1>
                            @else
                                @foreach($rooms as $room)
                                    <div class='bg-violet-50 dark:bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg'>
                                            <p class='pt-2 px-2 py-1 ml-2 mb-2 text-xs font-semibold text-purple-500'>{{ $room->created_at }}</p>
                                            <P class='px-2 py-1 ml-2 mb-2 text-2xl font-bold'>{{ $room->title }}</P>
                                            <P class='px-2 py-1 ml-2 mb-2 text-lg font-bold'>{{ $room->comment }}</P>
                                            <P class='px-2 py-1 ml-2 mb-2 text-xl font-bold'>{{ $room->first_bench_team }} VS {{ $room->third_bench_team }}</P>
                                            <div class='mt-2 ml-4 px-2 py-1 ml-2 mb-2 inline-flex justify-center items-center gap-2 rounded-md border-2 border-purple-500 font-semibold text-purple-500 hover:text-white hover:bg-purple-500 hover:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800'><a href="rooms/{{ $room->id }}/preview">のぞいてみる</a></div>
                                    <div/>
                                    <div style='border-bottom: 1px solid violet'>
                                        
                                    </div>
                                @endforeach
                            @endif   
                    </div>
                </div>
            <div>
                <div>
                    <div class="pt-4">
                        <div  class="btn-group">
                            {{ $rooms->links() }}
                        </div>  
                    </div>
                <div class="pt-4 pb-8 pl-44"> 
                    <p class="rounded-full py-3 px-6 py-2 ml-2 mb-2 inline-flex justify-center items-center gap-2 rounded-md border-2 border-purple-200 font-semibold text-purple-500 hover:text-white hover:bg-purple-500 hover:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
                            <a href="/rooms/create">作成</a>
                    </p>
                </div>
            </div>
        </body>
    </x-app-layout>
</html>