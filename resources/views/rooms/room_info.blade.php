<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ルーム詳細画面</title>
        
    </head>
    <x-app-layout>
        <x-slot dname="hedader">
            <h2 class="pt-16 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('ルーム詳細情報') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
        <body class="antialiased">
            <div class="bg-violet-50 ">
                    <div class="pt-16 pl-20 pb-1 pr-20">    
                        <div class=' border-solid  bg-white  rounded-lg bg-violet-50'>
                            <p class='px-2 py-1 ml-2 mb-2 text-xs font-semibold text-purple-500'>{{ $room->created_at }}</p>
                            <h1 class='px-2 py-1 ml-2 mb-2 text-xl font-bold'>タイトル：{{ $room->title }}</h1>
                            <p class='px-2 py-1 ml-2 mb-2 text-xl font-bold'>カテゴリ：{{ $room->category }}</p>
                            <P class='px-2 py-1 ml-2 mb-2 text-xl font-bold'>コメント：{{ $room->comment }}</P>
                            <p class='px-2 py-1 ml-2 mb-2 text-xl font-bold'>作成者：{{ $room->room_creator_name }}</p>
                            <P class='px-2 py-1 ml-2 mb-2 text-xl font-bold'>試合情報：{{ $room->first_bench_team }} VS {{ $room->third_bench_team }}</P>
                            <div class='ml-4 px-2 py-1 ml-2 mb-2 inline-flex justify-center items-center gap-2 rounded-md border-2 border-purple-500 font-semibold text-purple-500 hover:text-white hover:bg-purple-500 hover:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800'>
                                <a href="/chat/{{ $room->id }}">ルームに入る</a>
                            </div>
                            <div class='ml-4 px-2 py-1 ml-2 mb-2 inline-flex justify-center items-center gap-2 rounded-md border-2 border-purple-500 font-semibold text-purple-500 hover:text-white hover:bg-purple-500 hover:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800'>
                                <a href="/">戻る</a>
                            </div>   
                        </div>
                    </div>
            </div>   
        </body>
    </x-app-layout>
</html>