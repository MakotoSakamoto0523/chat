<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>チャット画面</title>
        
    </head>

    <x-app-layout>
        <body class="bg-violet-50">
            <div class="bg-violet-50 h-full">
            <div class="pt-14 bg-violet-50 h-full">
                <div class="fixed w-full pt-2 pl-60 pr-60">    
                    <div class='border-solid  bg-violet-50  rounded-lg'>
                        <a class='mt-2 ml-2 px-2 py-1 ml-2 mb-2 inline-flex justify-center items-center gap-2 rounded-md border-2 border-purple-500 font-semibold text-purple-500 hover:text-white hover:bg-purple-500 hover:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800' href="/">戻る</a>
                        <h1 class='pl-2 font-bold text-2xl'>{{ $room->title }}</h1>
                        <P class='pl-2 pt-1 font-bold text-sm'>{{ $room->comment }}</P>
                        <P class="pl-2 pt-1 font-bold text-lg">{{ $room->first_bench_team}}vs{{ $room->third_bench_team}}</P>
                        <a class='px-2 py-1 ml-2 mb-2 inline-flex justify-center items-center gap-2 rounded-md border-2 border-purple-500 font-semibold text-purple-500 hover:text-white hover:bg-purple-500 hover:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800' href="/game_predict/{{ $room->id }}">勝敗予想をする</a>
                            <div class="inline-flex pl-4 pt-2">
                                @if( Auth::user()->name === $room->room_creator_name )
                                    <a class="inline-flex px-2 py-1 ml-2 mb-2 inline-flex justify-center items-center gap-2 rounded-md border-2 border-green-700 font-semibold text-green-700 hover:text-white hover:bg-green-700 hover:border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800" href="/rooms/{{ $room->id }}/edit">編集</a>
                                    <form action="/rooms/{{ $room->id }}" id="form_{{ $room->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class='px-2 py-1 ml-2 mb-2 inline-flex justify-center items-center gap-2 rounded-md border-2 border-red-500 font-semibold text-red-500 hover:text-white hover:bg-red-500 hover:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800' type="button" onclick="deleteRoom( {{ $room->id }} )">削除</button>
                                    </form>
                                @else
                                    <a></a>
                                @endif
                            </div>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <div>
                    <div class="pt-44 pl-60 pr-60">
                        <ul class="border-solid  bg-violet-50  rounded-lg" id="list_message">
                            @foreach( $chats as $chat)
                               <li class="pl-3 pt-1 text-xs">{{ $chat->user->name }}</li> 
                               <li class="px-2 ml-2 mb-2 inline-flex justify-center items-center border-2 bg-white  border-gray-100 rounded-md font-semibold ">{{ $chat->body }}</li>
                               @isset($game_predicts->where('user_id',$chat->user_id)->first()->choice)
                                          @if($game_predicts->where('user_id',$chat->user_id)->first()->choice == 0)<p class="px-2 ml-2 mb-2 inline-flex bg-purple-600 rounded-lg text-xs text text-white">勝敗予想：{{$room->first_bench_team}}勝利</P>
                                          @else<p class="px-2 ml-2 mb-2 inline-flex bg-purple-600 rounded-lg text-xs text-white">勝敗予想：{{$room->third_bench_team}}勝利</P>
                                          @endif
                               @else<a class="px-2 ml-2 mb-2 inline-flex bg-purple-600 rounded-lg text-xs text-white" href="/game_predict/{{ $room->id }}">勝敗予想をしよう</a>
                               @endisset
                            @endforeach
                        </ul>
                            <div class="pt-1">
                                <div class="w-full pt-2 pl-2 inline-block ">
                                    <div class="border-solid rounded-lg">
                                        <div class="">
                                            <input type="hidden" name="chat[room_id]" value="{{$room->id}}">
                                            <input class=" pl-1 border-purple-500 focus:ring-purple-500 focus:ring-white-500 focus:outline-none appearance-none  text-sm leading-6 text-slate-900 placeholder-slate-400 rounded-md py-2 pl-10 ring-1 ring-slate-200 shadow-sm" type="text"  name="chat[body]" id="input_message" value="{{ old('chat.body') }}"/>
                                            <button class="px-2 py-1 ml-2 mb-2 inline-flex justify-center items-center gap-2 rounded-md border-2 border-purple-200 font-semibold text-purple-500 hover:text-white hover:bg-purple-500 hover:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800" type="button" onclick="onsubmit_Form({{ $room->id }}); return false;">送信</button>
                                            <p class="body__error" style="color:red">{{ $errors->first('chat.body') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            </div>
            
        </body>
        <script>
        
            //削除処理
            function deleteRoom(id) {
                'use strict'
                
                if(confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
            
        
        
            const elementInputMessage = document.getElementById( "input_message" );
            
            {{-- formのsubmit処理 --}}
            function onsubmit_Form(room_id)
            {
                
                {{-- 送信用テキストHTML要素からメッセージ文字列の取得 --}}
                let strMessage = elementInputMessage.value;
                if( !strMessage )
                {
                    return;
                }
    
                params = { 'message': strMessage , 'room_id':  room_id　};
                
                console.log(strMessage ,);
                {{-- POSTリクエスト送信処理とレスポンス取得処理 --}}
                axios
                    .post( '/input', params )
                    .then( response => {
                        console.log(response);
                    } )
                    .catch(error => {
                        console.log(error.response)
                    } );
    
                {{-- テキストHTML要素の中身のクリア --}}
                elementInputMessage.value = "";
            }
            {{-- ページ読み込み後の処理 --}}
            window.addEventListener( "DOMContentLoaded", ()=>
            {
                
                
                const elementListMessage = document.getElementById( "list_message" );
                
                {{-- Listen開始と、イベント発生時の処理の定義 --}}
                window.Echo.private('chat').listen( 'MessageSent', (e) =>
                {
            
　               
　                            
                    console.log(e);
                    {{-- メッセージの整形 --}}
                    
                    let name = e.chat.user.name;
                    
                    let strMessage = e.chat.body;
                    
                
                    let gamePredict = e.choice;
                    //勝敗予想の処理
                    //let gamePredict = e.gamePredict.choice;
                    
    
                    {{-- 拡散されたメッセージをメッセージリストに追加 --}}
                    let elementLi = document.createElement( "li" );
                    let elementName = document.createElement( "li" );
                    
                    //勝敗予想の処理
                    let elementGamePredict = document.createElement( "li" );
                    
                    let elementMessage = document.createElement( "div" );
                    
                    elementName.textContent = name;
                    elementName.style.cssText = "padding: 11px 20px 0px 12px; font-size: small;";
                    elementMessage.textContent = strMessage;
                    elementMessage.style.cssText = "padding: 0em 10px 0px 10px; margin-bottom: 16px; font-weight: 600;background-color: white;display: inline; margin: 0em 10px 0px 10px; border-radius: 3px;";
                    
                    //勝敗予想の処理
                        if( gamePredict == null){
                           elementGamePredict.textContent = "勝敗予想をしよう"
                        }else{
                           elementGamePredict.textContent = "勝敗予想："+ gamePredict +"勝利";
                        }
                    
                    elementGamePredict.style.cssText = "font-size: 12px; background-color: #9933FF; border-radius: 10px; color: white; padding: 0em 10px 0px 9px; display: inline;";
                    
                    elementLi.append( elementName );
                    elementLi.append( elementMessage );
                    //勝敗予想の処理
                    elementLi.append( elementGamePredict );
                    //elementListMessage.prepend( elementLi );  // リストの一番上に追加
                    elementListMessage.append( elementLi ); // リストの一番下に追加
                    
                
                    
                      
                });
            } );
    　　</script>
    </x-app-layout>
</html>