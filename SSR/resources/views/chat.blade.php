@extends('layouts.user.app')

@section('content')
    <link href="{{ asset('css/chat-header.css') }}" rel="stylesheet">
    <div class="containerchat clearfix">
        <div class="row justify-content-center">
            <h2 id="title">Chat list</h2>
        </div>
        <hr>
        <div class="people-list" id="people-list">
            <ul class="list">
            <li class="clearfix">
                <h5>Daftar User</h5>
                <hr>
            </li>
            @forelse ($alluser as $listacc)
                <li class="clearfix">
                    <img src="{{ asset('user/nophoto.jpeg') }}" alt="avatar" />
                    <div class="about">
                    <div class="name"><a href="javascript:void(0)" onclick="readmessage({{ $listacc->id }}, '{{ $listacc->username }}', '{{ $listacc->user_picture }}')">{{ $listacc->username }}</a></div>
                    <div class="status3">
                        <i class="fa fa-circle online"></i>{{ $listacc->cnt }} New Message
                    </div>
                    </div>
                </li>
            @empty
                Kosong
            @endforelse

            </ul>
        </div>

        <div class="chat">
            <div class="chat-header clearfix">
                {{-- <img id="profile-picture" src="{{ asset('user/nophoto.jpeg') }}" alt="avatar" /> --}}
                {{-- <caption>Choose who to chat!</caption> --}}
                {{-- <img  alt="choose who to chat" /> --}}
                    <?php echo '<img style="border-radius: 50%;" src="">'; ?>
                <div class="chat-about">
                    <div class="chat-with"></div>
                </div>
            </div>

            <div class="chat-history">
            </div>

            <div class="chat-message clearfix">
            <textarea name="message-to-send" id="message-to-send" placeholder="Type your message" rows="1"></textarea>

            <button name="btnkirim" onclick="ajaxsend(0)">KIRIM</button>

            </div>
        </div>
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('d3036964e5c8d3dd7e2b', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('message-send', function(data) {
        addData(data);
    });

    function addData(data) {
        var str = '';var idtuju=-1;
        str+='<ul>';
        for (var z in data["message"]) {
            if (data["message"][z].chat_sendder==1) {
                str+='<li class="clearfix"><div class="message-data align-right"><span class="message-data-time" >'+data["message"][z].chat_time+'</span> &nbsp; &nbsp;<span class="message-data-name" >'+data["message"][z].user_username+'</span><i class="fa fa-circle me"></i></div><div class="message other-message float-right">'+data["message"][z].chat_message+'</div></li>';
            }
            else {
                str+='<li><div class="message-data"><span class="message-data-name"><i class="fa fa-circle online"></i>'+data["message"][z].user_username+'</span><span class="message-data-time">'+data["message"][z].chat_time+'</span></div><div class="message my-message">'+data["message"][z].chat_message+'</div></li>';
                idtuju=data["message"][z].chat_sendder;
            }
        }
        str+='</ul>';
        $('.status'+idtuju).html('<i class="fa fa-circle online"></i> 0 New Message');
        console.log(str);
        $('.chat-history').html(str);
    }
    </script>
    <script>
    var tujuan = 1;
    function ajaxsend(baca) {
        if (tujuan != -1) {
            if (baca==1) {
                var value = {
                    "_token": "{{ csrf_token() }}",
                    receiver: tujuan,
                    message: 'baca'
                }
            }else {
                var value = {
                    "_token": "{{ csrf_token() }}",
                    receiver: tujuan,
                    message: $("#message-to-send").val()
                }
            }

            $.ajax({
                type: "POST",
                url: '/chat/send',
                data: value,
                dataType: 'JSON',
                cache: false,
                success:
                    function(data){
                    alert(data);
                }
            });
        }
        $("#message-to-send").val("");
    }
    function readmessage(to,nama,pict){
        $('#title').html('You are chatting with ' + nama);
        $(".chat-with").html(nama);
        // $("#profile-picture").attr("src",pict);
        tujuan=to; ajaxsend(1);
    }
    </script>

@endsection
