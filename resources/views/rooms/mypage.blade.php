<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>マイルーム</title>
        
    </head>
    <x-app-layout>
        <body class="antialiased">
            <div class="py-6">
                <div class="pt-14 max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-violet-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ __("あなたが過去にコメントしたルームを最新順に表示しています") }}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if($roomsCount == 0)
                        <h1 class="pt-10 pr-10 text-center text-4xl text-gray-400">ルームはまだありません</h1>
                    @else    
                        @foreach($myrooms as $myroom)
                            <div class='bg-violet-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg'>
                                <p class='px-2 py-1 ml-2 mb-2 text-xs font-semibold text-purple-500'>{{ $myroom->created_at }}</p>
                                <P class='px-2 py-1 ml-2 mb-2 text-2xl font-bold'>{{ $myroom->title }}</P>
                                <P class='px-2 py-1 ml-2 mb-2 text-lg font-bold'>{{ $myroom->comment }}</P>
                                <P class='px-2 py-1 ml-2 mb-2 text-xl font-bold'>{{ $myroom->first_bench_team }} VS {{ $myroom->third_bench_team }}</P>
                                <div class='mt-2 ml-4 px-2 py-1 ml-2 mb-2 inline-flex justify-center items-center gap-2 rounded-md border-2 border-purple-500 font-semibold text-purple-500 hover:text-white hover:bg-purple-500 hover:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800'><a href="/rooms/{{ $myroom->id }}/preview">のぞいてみる</a></div>
                            </div>
                            <div style='border-bottom: 1px solid violet'>
                                        
                            </div>
                        @endforeach
                    @endif    
                </div>
            </div>    
                <div>
                    <div　class="btn-group">
                        {{ $myrooms->links() }}
                    </div>  
                </div>
        </body>
    </x-app-layout>
</html>