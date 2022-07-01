<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <title>Teste de Chat</title>
</head>
<body>
   <div class="container">
       <div class="row d-flex justify-content-center">
           <div class="col-lg-8 rounded" style="background-color: #23c861;">
               <!-- Cabeçalho -->
               <div class="d-flex flex-row align-top p-3">
                   <div class="mr-4">
                       <img class="pr-4" src="https://logodownload.org/wp-content/uploads/2015/04/whatsapp-logo-1.png" style="width: 50px; height: 50px;">
                   </div>
                   <div class="align-center">
                       <strong><p class="p-2" style="font-size: 1.2rem; color: white;">Teste de Chat</p></strong>
                   </div>
               </div>

               <!-- Corpo de mensagens -->
               <div class="border border-success rounded p-3" style="background-color: blanchedalmond; width: 100%; height: 600px;">
                   @if (isset($text) && $text != '')
                       <div class="d-flex justify-content-end">
                           <!-- enviar a mensagem pro controller e mandar o retorno dela com o with na view -->
                           <div class="p-2 rounded" style="width: 400px; height: 50px;background-color: white;">
                               <p>{{ $text }}</p>
                           </div>
                       </div>
                   @endif

                   @if (isset($mensagem) && $mensagem != '')
                       <div class="d-flex justify-content-start">
                           <div class="p-2 rounded" style="width: 400px; height: 100px;background-color: white;">
                               <p>{{ $mensagem }}</p>
                           </div>
                       </div>
                   @endif
               </div>

               <!-- Área de envio das mensagens -->
               <div class="align-end p-1">
                   <div class="row">
                       <form class="col-lg-12" action="{{ route('mensagem.enviar') }}" method="POST">
                           @csrf
                           <div class="row">
                               <!-- div para inputs a serem enviados por request -->
                               <div hidden>
                                   <input value="{{ $projectId }}" name="projectId">
                                   <input value="{{ $sessionId }}" name="sessionId">
                               </div>
                               <div class="col-11">
                                   <textarea class="form-control" style="min-width: 100%" rows="4" name="text"></textarea>
                               </div>
                               <div class="col-1">
                                   <button class="btn btn-outline-light" type="submit" title="Enviar"><ion-icon name="send-outline"></ion-icon></button>
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
</body>
</html>
