<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>room_info</title>
        
    </head>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('ルーム情報') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
        <body class="antialiased">
            <div>
                <h1>ルーム情報</h1>
            </div>
            <div>
                <div>
                    <h1>みんなで野球を見よう</h1>
                </div>
                <div>
                    <p>投稿者　坂本真人</p>
                    <P>コメント　阪神ファンや巨人ファンの人募集中</P>
                </div>
            </div>
            <div>
                <a href="">ルームに入る</a>
            </div>
    
        </body>
    </x-app-layout>
</html>