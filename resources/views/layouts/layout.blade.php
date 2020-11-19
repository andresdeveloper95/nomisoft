<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nomisoft</title>
    <link rel="icon" type="image/jpg" href="img/ic.jpg  "/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('assets\air-datepicker\dist\css\datepicker.css')}}">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Estas líneas son de los data table -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    
    <!-- SweetAlert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<style>
   .bg-nav {
   background-color: #E61313;
   }
</style>

<body>
        <!--Aqui barra de navegación -->

    <div id="app">
      <nav class="navbar navbar-expand-md navbar-light bg-nav shadow-md">
            <div class="container">
                <img src="{{ asset('img/logosi.jpg') }}" style=" width: 65px; height: 80px;">

                <a class=" navbar-brand text-white " style="font-size: 40px; " >   Universidad del Valle  </a>

               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="nav-tab" role="tablist">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav nav-tabs">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <!--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>-->
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <!--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>-->
                                </li>
                            @endif
                        @else

            

                    <!--validacion de usuarios por el rol secretaria -->
            @if ( Auth::user()->rol=='S' )
            <!--(Route::has('homeSecretaria'))-->

           <div> 
                <li class="nav-item dropdown">     
                        <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('porteros.listar') }}">
                            {{ __('Porteros') }}
                        </a>
                </li>
            </div>
            <div>
                <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('turnos.listar') }}">
                        {{ __('Turnos') }}
                </a>
            </div>
            <div>
                <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('recargos.mostrar') }}">
                        {{ __('Recargos') }}
                </a>
            </div>
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" style="font-size: 20px;" href="#" role="button" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Cerrar Sesión') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
            </div>
        
                    <!--validacion de usuarios por el rol portero-->
            
                 @elseif (Auth::user()->rol==='P')

              <div> 
                    <li class="nav-item">     
                        <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('horarios.portero') }}">
                            {{ __('Consultar Horario') }}
                        </a>
                    </li>
                </div>

                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" style="font-size: 20px;"  href="#" role="button" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Cerrar Sesión') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" 
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
            


                    <!--validacion de usuarios por el rol administrador -->
                @else

                
                    <div> 
                    <li class="nav-item">     
                        <a class="nav-link text-white"   style="font-size: 20px;" href="{{ route('porteros.listar') }}">
                            {{ __('Porteros') }}
                        </a>
                    </li>
                </div>
                <div>
                
                    <a class="nav-link text-white"  style="font-size: 20px;" href="{{ route('turnos.listar') }}">
                            {{ __('Turnos') }}
                    </a>
                </div>
                <div>
                    <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('horarios.listar') }}">
                            {{ __('Horarios') }}
                        </a>
                </div>
                <div>
                    <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('recargos.mostrar') }}">
                            {{ __('Recargos') }}
                    </a>
                </div>
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" style="font-size: 20px;" href="#" role="button" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}<span class="caret"></span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Cerrar Sesión') }}
                        </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    </div>


    <div>
        <main class="py-4">
           
        <!-- Aqui todo nuestro codigo, includes y otros -->
        @yield('content')
        @yield('content1')
        @yield('content2')
        @include('crearPortero')
        @include('eliminarPortero')
        @include('actualizarPortero')
        @include('crearTurno')
        @include('eliminarTurno')
        @include('actualizarTurno')
        @include('crearHorario')
        @include('eliminarHorario')
        @include('actualizarHorario')
        


        

        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" defer></script>
    <script src="{{asset('assets\air-datepicker\dist\js\datepicker.js')}}"></script>
    <script src="{{asset('assets\air-datepicker\dist\js\i18n\datepicker.es.js')}}"></script>

</body>

    <!-- Footer -->
<footer class="page-footer font-small special-color-dark pt-4">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Derechos Reservados A&J Soft
    
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</html>

<!-- Método para mostrar los porteros -->

<script>
    $(function(){
        $('#tablePorteros').DataTable(
        {
            "serverSide":true,
            "ajax":"{{ url('api/porteros')}}",
            "columns":[
                {data:'id'},
                {data:'cedula'},
                {data:'name'},
                {data:'apellidos'},
                {data:'direccion'},
                {data:'telefono'},
                {data:'email'},
                {data:'btn'},
            ],
            "pageLength":12,
            language:{
                "search": "Buscar:",
            },
            "paging":false,
            "info":false,
        });
    });
</script>

<!-- Método para crear los porteros -->

<script>
     $('#registro').click(function(){
        var ced=$('#_documento').val();
        var nom=$('#_nombres').val();
        var ape=$('#_apellidos').val();
        var dir=$('#_direccion').val();
        var tel=$('#_telefono').val();
        var cor=$('#email').val();
        
        var route="porteros";
        var token=$('#token').val();

        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN': token},
            type:'POST',
            dataType:'json',
            data:{
                cedula:ced,
                name:nom,
                apellidos:ape,
                direccion:dir,
                telefono:tel,
                email:cor,
            },

            success:function(response){
                if(response == "no se pudo"){
                    swal("!No es posible crear el portero", {
                    icon: "error",
                    });
                }
                else if(response == "Se creo"){
                    swal("¡El portero se ha creado exitosamente!", {
                    icon: "success",
                    });
                }
            },            
        });
        $('#tablePorteros').DataTable().ajax.reload();
         
        
    });
</script>

<!-- Método para el modal eliminar porteros-->

<script>
    $(function(){
        var table=$('#tablePorteros').DataTable();

        table.on('click','.delete',function(){

            swal({
              title: "¿Está seguro que desea eliminar portero?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

            $tr=$(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr=$tr.prev('.parent');
            }
            var data=table.row($tr).data();
            //$('#idEliminar').val(data.id);
            //$('#deletePortero1').modal('show');
            var idEliminar=data.id;
            var route="/porteros/eliminar/"+idEliminar;

            $.ajax({
                    url:route,
                   // headers:{'X-CSRF-TOKEN': token},
                    type:'DELETE',
                    dataType:'json',
                    data:{
                    id:idEliminar,  
                    },
        });
        $('#tablePorteros').DataTable().ajax.reload();
         swal("¡El portero se ha eliminado correctamente!", {
                  icon: "success",
                });
              } 
            });


        });    
    });
</script>

<!-- Método para eliminar los porteros
<script>
    $("#elimina").click(function(){
        var idEliminar=$("#idEliminar").val();
        var token=$("#token").val();
        var route="/porteros/eliminar/"+idEliminar;
        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN': token},
            type:'DELETE',
            dataType:'json',
            data:{
                id:idEliminar,  
            }
        });
        $('#tablePorteros').DataTable().ajax.reload();
    });
</script> -->


<!-- Método para mostrar el modal que actualizar porteros  -->
<script>
    $(function(){
        var table=$('#tablePorteros').DataTable();

        table.on('click','.edit',function(){
            $tr=$(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr=$tr.prev('.parent');
            }
            var data=table.row($tr).data();
            $('#idActualizar').val(data.id);
            $('#nombres1').val(data.name);
            $('#apellidos1').val(data.apellidos);
            $('#direccion1').val(data.direccion);
            $('#telefono1').val(data.telefono);
            $('#correo1').val(data.email);

            $('#updatePortero').modal('show');  

        });    
    });
</script>


<!-- Método para actualizar porteros-->

<script>
    $('#registroUpdate').click(function(){

         swal({
          title: "¿Está seguro que desea actualizar portero?",
        
          icon: "info",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

        var idactualizar=$('#idActualizar').val();
        var nom=$('#nombres1').val();
        var ape=$('#apellidos1').val();
        var dir=$('#direccion1').val();
        var tel=$('#telefono1').val();
        
        var route="/porteros/actualizar/"+idactualizar;

        var token=$('#token1').val();

        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN': token},
            type:'PATCH',
            dataType:'json',
            data:{
                name:nom,
                apellidos:ape,
                direccion:dir,
                telefono:tel,
            },
        });
        $('#tablePorteros').DataTable().ajax.reload();
         swal("¡El portero se ha modificado correctamente!", {
              icon: "success",
            });
          } 
        });  
    });
</script>

<!-- Método para mostrar los turnos -->

<script>
    $(function(){
        $('#tableTurnos').DataTable(
        {
            "serverSide":true,
            "ajax":"{{ url('api/turnos')}}",
            "columns":[
                {data:'id'},
                {data:'codigo'},
                {data:'horaInicio'},
                {data:'horaFin'},
                {data:'btn'},
            ],
            "pageLength":8,
            language:{
                "search": "Buscar:",
            },
            "paging":false,
            "info":false,
        });
    });
</script>

<!-- Método para crear los turnos -->

<script>
     $('#registroTurno').click(function(){
        var cod=$('#_codigo').val();
        var ini=$('#_horaInicio').val();
        var fin=$('#_horaFin').val();

        var route="turnos";
        var token=$('#token').val();

        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN': token},
            type:'POST',
            dataType:'json',
            data:{
                codigo:cod,
                horaInicio:ini,
                horaFin:fin,
            },
            success:function(response){
                if(response == "turnoMalo"){
                    swal("!No es posible crear el turno", {
                    icon: "error",
                    });
                }
                else if(response == "turnoBueno"){
                    swal("¡El turno se ha creado exitosamente!", {
                    icon: "success",
                    });
                }
            },            
        });
        $('#tableTurnos').DataTable().ajax.reload();
         
        
    });
        
</script>

<!-- Método para el modal eliminar turno -->

<script>
    $(function(){
        //$("#deleteTurno").appendTo("body");
        var table=$('#tableTurnos').DataTable();

        table.on('click','.delete',function(){

            swal({
              title: "¿Está seguro que desea eliminar turno?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

            $tr=$(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr=$tr.prev('.parent');
            }
            var data=table.row($tr).data();
            var idEliminar=data.id;
            //$('#idEliminarTurno').val(data.id);
            //$('#deleteTurno').modal('show');
            var route="/turnos/eliminar/"+idEliminar;

             $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN': token},
            type:'DELETE',
            dataType:'json',
            data:{
                id:idEliminar,  
            }
        });
        $('#tableTurnos').DataTable().ajax.reload();  

           swal("¡El turno se ha eliminado correctamente!", {
                  icon: "success",
                });
        }  
            }); 
        });    
    });
</script>

<!-- Método para eliminar los turnos 

<script>
    $("#eliminaTurno-btn").click(function(){
        var idEliminar=$("#idEliminarTurno").val();
        var token=$("#token").val();
        var route="/turnos/eliminar/"+idEliminar;
        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN': token},
            type:'DELETE',
            dataType:'json',
            data:{
                id:idEliminar,  
            }
        });
        $('#tableTurnos').DataTable().ajax.reload();
    });
</script>   -->

<!-- Método para mostrar el modal que actualizar turno -->

<script>
    $(function(){
        //$("#uptadeTurno1").appendTo("body");
        var table=$('#tableTurnos').DataTable();
        

        table.on('click','.edit',function(){
            $tr=$(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr=$tr.prev('.parent');
            }
            var data=table.row($tr).data();
            $('#idActualizarTurno').val(data.id);
            $('#inicio1').val(data.horaInicio);
            $('#fin1').val(data.horaFin);

            $('#updateTurno1').modal('show');  

        });    
    });
</script>

<script>
    //Esta línea es porque el modal estaba molestando al cerrar, quedaba atenuado
    $(function(){
     $("#updateTurno1").appendTo("body");
    });
</script>

<!-- Método para actualizar porteros turno-->

<script>
    $('#registroUpdateTurno').click(function(){

        swal({
          title: "¿Está seguro que desea actualizar turno?",
        
          icon: "info",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {


        var idactualizar=$('#idActualizarTurno').val();
        var inicio=$('#inicio1').val();
        var fin=$('#fin1').val();
        
        var route="/turnos/actualizar/"+idactualizar;

        var token=$('#token3').val();

        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN': token},
            type:'PATCH',
            dataType:'json',
            data:{
                horaInicio:inicio,
                horaFin:fin, 
            },
        });
        $('#tableTurnos').DataTable().ajax.reload();
        swal("¡El turno se actualizó correctamente!", {
              icon: "success",
            });
        }
         });
    });
</script>

<!-- Método para mostrar los horarios -->

<--
<script>
    $(function(){
        $('#tableHorarios').DataTable(
        {
            "serverSide":true,
            "ajax":"{{ url('api/horarios')}}",
            "columns":[
                {data:'porteros'},
                {data:'sede'},
                {data:'mes'},
                {data:'primero'},
                {data:'segundo'},
                {data:'tercero'},
                {data:'cuarto'},
                {data:'quinto'},
                {data:'sexto'},
                {data:'septimo'},
                {data:'octavo'},
                {data:'noveno'},
                {data:'decimo'},
                {data:'once'},
                {data:'doce'},
                {data:'trece'},
                {data:'catorce'},
                {data:'quince'},
                {data:'dieciseis'},
                {data:'diecisiete'},
                {data:'diesocho'},
                {data:'diecinueve'},
                {data:'veinte'},
                {data:'veintiuno'},
                {data:'veintidos'},
                {data:'veintitres'},
                {data:'veinticuatro'},
                {data:'veinticinco'},
                {data:'veintiseis'},
                {data:'veintisiete'},
                {data:'veintiocho'},
                {data:'veintinueve'},
                {data:'treinta'},
                {data:'treintayuno'},
                {data:'btn'},
            ],
            "pageLength":8,
            language:{
                "search": "Buscar:",
            },
            "paging":false,
            "info":false,
        });
    });
</script>


<!-- Método para crear los horarios -->

<script>
     $('#agregarHorario').click(function(){
        var porteros=$('#idporteros').val();
        var sede=$('#idsede').val();
        var mes=$('#idmes').val();        
        var primero=$('#idprimero').val();
        var segundo=$('#idsegundo').val();
        var tercero=$('#idtercero').val();
        var cuarto=$('#idcuarto').val();
        var quinto=$('#idquinto').val();
        var sexto=$('#idsexto').val();
        var septimo=$('#idseptimo').val();
        var octavo=$('#idoctavo').val();
        var noveno=$('#idnoveno').val();
        var decimo=$('#iddecimo').val();
        var once=$('#idonce').val();
        var doce=$('#iddoce').val();
        var trece=$('#idtrece').val();
        var catorce=$('#idcatorce').val();
        var quince=$('#idquince').val();
        var dieciseis=$('#iddieciseis').val();
        var diecisiete=$('#iddiecisiete').val();
        var diesocho=$('#iddiesocho').val();
        var diecinueve=$('#iddiecinueve').val();
        var veinte=$('#idveinte').val();
        var veintiuno=$('#idveintiuno').val();
        var veintidos=$('#idveintidos').val();
        var veintitres=$('#idveintitres').val();
        var veinticuatro=$('#idveinticuatro').val();
        var veinticinco=$('#idveinticinco').val();
        var veintiseis=$('#idveintiseis').val();
        var veintisiete=$('#idveintisiete').val();
        var veintiocho=$('#idveintiocho').val();
        var veintinueve=$('#idveintinueve').val();
        var treinta=$('#idtreinta').val();
        var treintayuno=$('#idtreintayuno').val();
        
        var route="horarios";
        var token=$('#tokenHorario').val();

        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN': token},
            type:'POST',
            dataType:'json',
            data:{
                porteros:porteros,
                sede:sede,
                mes:mes,
                primero:primero,
                segundo:segundo,
                tercero:tercero,
                cuarto:cuarto,
                quinto:quinto,
                sexto:sexto,
                septimo:septimo,
                octavo:octavo,
                noveno:noveno,
                decimo:decimo,
                once:once,
                doce:doce,
                trece:trece,
                catorce:catorce,
                quince:quince,
                dieciseis:dieciseis,
                diecisiete:diecisiete,
                diesocho:diesocho,
                diecinueve:diecinueve,
                veinte:veinte,
                veintiuno:veintiuno,
                veintidos:veintidos,
                veintitres:veintitres,
                veinticuatro:veinticuatro,
                veinticinco:veinticinco,
                veintiseis:veintiseis,
                veintisiete:veintisiete,
                veintiocho:veintiocho,
                veintinueve:veintinueve,
                treinta:treinta,
                treintayuno:treintayuno,
            },
            
            success:function(respuesta){
                //console.log("si entra cuando está bueno");
                if(respuesta == "No se puede"){
                    swal("No es posible porque el portero debe salir a descanso", {
                     icon: "error",
                    });
                }
                else{
                    swal("¡El horario se ha creado correctaemente!", {
                    icon: "success",
                    });
                }
                
            },
        });
        
        $('#tableHorarios').DataTable().ajax.reload();
        
    });
</script>

<!-- Método para el modal eliminar -->

<script>
    $(function(){
        $("#modalHorario").appendTo("body");
        var table=$('#tableHorarios').DataTable();

        table.on('click','.delete',function(){
            $tr=$(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr=$tr.prev('.parent');
            }
            var data=table.row($tr).data();
            $('#idEliminarHorario').val(data.id);
            $('#modalHorario').modal('show');     
        });    
    });
</script>

<!-- Método para eliminar los horarios -->

<script>
    $("#btn-eliminarHorario").click(function(){
        var idEliminar=$("#idEliminarHorario").val();
        var token=$("#token").val();
        var route="/horarios/eliminar/"+idEliminar;
        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN': token},
            type:'DELETE',
            dataType:'json',
            data:{
                id:idEliminar,  
            }
        });
        $('#tableHorarios').DataTable().ajax.reload();
    });
</script>


<!-- Método para mostrar el modal que actualiza -->

<script>
    $(function(){
        var table=$('#tableHorarios').DataTable();

        table.on('click','.edit',function(){
            $tr=$(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr=$tr.prev('.parent');
            }
            var data=table.row($tr).data();
            $('#idActualizarHorario').val(data.id);
            $('#idsede1').val(data.sede);
            $('#idmes1').val(data.mes);
            $('#idprimero1').val(data.primero);
            $('#idsegundo1').val(data.segundo);
            $('#idtercero1').val(data.tercero);
            $('#idcuarto1').val(data.cuarto);
            $('#idquinto1').val(data.quinto);
            $('#idsexto1').val(data.sexto);
            $('#idseptimo1').val(data.septimo);
            $('#idoctavo1').val(data.octavo);
            $('#idnoveno1').val(data.noveno);
            $('#iddecimo1').val(data.decimo);
            $('#idonce1').val(data.once);
            $('#iddoce1').val(data.doce);
            $('#idtrece1').val(data.trece);
            $('#idcatorce1').val(data.catorce);
            $('#idquince1').val(data.quince);
            $('#iddieciseis1').val(data.dieciseis);
            $('#iddiecisiete1').val(data.diecisiete);
            $('#iddiesocho1').val(data.diesocho);
            $('#iddiecinueve1').val(data.diecinueve);
            $('#idveinte1').val(data.veinte);
            $('#idveintiuno1').val(data.veintiuno);
            $('#idveintidos1').val(data.veintidos);
            $('#idveintitres1').val(data.veintitres);
            $('#idveinticuatro1').val(data.veinticuatro);
            $('#idveinticinco1').val(data.veinticinco);
            $('#idveintiseis1').val(data.veintiseis);
            $('#idveintisiete1').val(data.veintisiete);
            $('#idveintiocho1').val(data.veintiocho);
            $('#idveintinueve1').val(data.veintinueve);
            $('#idtreinta1').val(data.treinta);
            $('#idtreintayuno1').val(data.treintayuno);

            $('#updateHorario1').modal('show');  
        });    
    });
</script>

<script>
    $('#registroUpdateHorario').click(function(){
        var idactualizar=$('#idActualizarHorario').val();
        var sede1=$('#idsede1').val();
        var mes1=$('#idmes1').val();
        var primero1=$('#idprimero1').val();
        var segundo1=$('#idsegundo1').val();
        var tercero1=$('#idtercero1').val();
        var cuarto1=$('#idcuarto1').val();
        var quinto1=$('#idquinto1').val();
        var sexto1=$('#idsexto1').val();
        var septimo1=$('#idseptimo1').val();
        var octavo1=$('#idoctavo1').val();
        var noveno1=$('#idnoveno1').val();
        var decimo1=$('#iddecimo1').val();
        var once1=$('#idonce1').val();
        var doce1=$('#iddoce1').val();
        var trece1=$('#idtrece1').val();
        var catorce1=$('#idcatorce1').val();
        var quince1=$('#idquince1').val();
        var dieciseis1=$('#iddieciseis1').val();
        var diecisiete1=$('#iddiecisiete1').val();
        var diesocho1=$('#iddiesocho1').val();
        var diecinueve1=$('#iddiecinueve1').val();
        var veinte1=$('#idveinte1').val();
        var veintiuno1=$('#idveintiuno1').val();
        var veintidos1=$('#idveintidos1').val();
        var veintitres1=$('#idveintitres1').val();
        var veinticuatro1=$('#idveinticuatro1').val();
        var veinticinco1=$('#idveinticinco1').val();
        var veintiseis1=$('#idveintiseis1').val();
        var veintisiete1=$('#idveintisiete1').val();
        var veintiocho1=$('#idveintiocho1').val();
        var veintinueve1=$('#idveintinueve1').val();
        var treinta1=$('#idtreinta1').val();
        var treintayuno1=$('#idtreintayuno1').val();
        
        var route="/horarios/actualizar/"+idactualizar;

        var token=$('#token4').val();

        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN': token},
            type:'PATCH',
            dataType:'json',
            data:{
                sede:sede1,
                mes:mes1,
                primero:primero1,
                segundo:segundo1,
                tercero:tercero1,
                cuarto:cuarto1,
                quinto:quinto1,
                sexto:sexto1,
                septimo:septimo1,
                octavo:octavo1,
                noveno:noveno1,
                decimo:decimo1,
                once:once1,
                doce:doce1,
                trece:trece1,
                catorce:catorce1,
                quince:quince1,
                dieciseis:dieciseis1,
                diecisiete:diecisiete1,
                diesocho:diesocho1,
                diecinueve:diecinueve1,
                veinte:veinte1,
                veintiuno:veintiuno1,
                veintidos:veintidos1,
                veintitres:veintitres1,
                veinticuatro:veinticuatro1,
                veinticinco:veinticinco1,
                veintiseis:veintiseis1,
                veintisiete:veintisiete1,
                veintiocho:veintiocho1,
                veintinueve:veintinueve1,
                treinta:treinta1,
                treintayuno:treintayuno1,
            },
        });
        $('#tableHorarios').DataTable().ajax.reload();
    });
</script>

<script>
    //Esta línea es porque el modal estaba molestando al cerrar, quedaba atenuado
    $(function(){
     $("#modalHorario").appendTo("body");
    });
</script>


<script>
    //Esta línea es porque el modal estaba molestando al cerrar, quedaba atenuado
    $(function(){
     $("#updateHorario1").appendTo("body");
    });
</script>



<script>
    //Esta línea es porque el modal estaba molestando al cerrar, quedaba atenuado
    $(function(){
     $("#createHorario").appendTo("body");
    });
</script>


<script>
$(document).ready(function() {
    $('#tablePorteros').DataTable();
} );
</script>

<script>
$(document).ready(function() {
    $('#tableTurnos').DataTable();
} );
</script>

<script>
$(document).ready(function() {
    $('#tableHorarios').DataTable();
} );
</script>

<script>
$('#msj').click(function(){
        
    swal("¡Se ha liquidado correctamente!", {
    icon: "success",
    });
    $('#tableRecargos').DataTable().ajax.reload();
                     
});
</script>



<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
</script>








