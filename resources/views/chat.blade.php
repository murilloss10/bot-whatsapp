<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
</head>
<body>
    <center>
        <div style="width: 400px; height: 800px; background-color: #a0aec0">
            <p>{{ $mensagem }}</p>
            <div style="width: 100%; height: 140px; background-color: #2d3748">
{{--                <form action="{{ route('chat', ['projectId' => 'teste-jwyo', 'sessionId' => '123456']) }}" method="POST">--}}
{{--                    @csrf--}}
                    <input type="text-area" style="width: 70%; height: 132px; background-color: white" name="text">
                    <button type="submit" style="width: 20%; height: 50px; background-color: aqua">Enviar</button>
{{--                </form>--}}
            </div>
        </div>
    </center>
</body>
</html>
