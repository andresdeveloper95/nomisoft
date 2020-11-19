@extends('layouts.layout')

@section('content2')

<!-- MDBootstrap Datatables  -->

<div class="row">

        <div>&nbsp;</div>
        <a href="{{ route('ayuda.horario') }}" class="btn btn-primary" style="float:right; margin-left: 1400px;" target="_blank" data-placement="top" title="Presione para obtener ayuda">
            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-question-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z"/>
            </svg>
        </a>
</div>

<div class="container">
<ol class="breadcrumb">
            <li><a href="{{ url('/') }} ">Menú Principal     </a></li>
            <p>       /</p>
            <li class="active">    Administrar Horarios</li>
</ol>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div id="all" class="card-header">
                    <center>
                        <h1>Administrar Horarios</h1>
                    </center>                         
                    </div>
                    <style type="text/css">
                        td {
                        border: 1px royalblue dotted;
                        width: 100px;
                        height: 50px;
                        text-align: center;
                        font-weight: bold;
                    }

                        #detallesInfo {
                        height: 450px !important;
                        overflow: auto;
                        width: 1100px;
                        margin: 0px;
	                    padding: 0px;

                    }

                    #all{
                        margin: 0px;
	                    padding: 0px;
                    }
            
                    </style>
                    <div id="detallesInfo" class="card-body">
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createHorario" data-toggle="tooltip" data-placement="top" title="Presione para crear horario">
                                 
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>

                            Crear Horario</button>

                        <table id="tableHorarios" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Portero</th>
                                    <th>Sede</th>
                                    <th>Mes</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>   
                                    <th>14</th>
                                    <th>15</th>
                                    <th>16</th>
                                    <th>17</th>
                                    <th>18</th>
                                    <th>19</th>
                                    <th>20</th>
                                    <th>21</th>
                                    <th>22</th>
                                    <th>23</th>
                                    <th>24</th>
                                    <th>25</th>
                                    <th>26</th>
                                    <th>27</th>
                                    <th>28</th>
                                    <th>29</th>
                                    <th>30</th>
                                    <th>31</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                             <tbody>
                                    @foreach($horarios as $horario)
                                        <tr>
                                            <td>{{ $horario->portero->name }}</td>
                                            <td>{{ $horario->sede }}</td>
                                            <td>{{ $horario->mes }}</td>
                                            <td>{{ $horario->primero }}</td>
                                            <td>{{ $horario->segundo }}</td>
                                            <td>{{ $horario->tercero }}</td>
                                            <td>{{ $horario->cuarto }}</td>
                                            <td>{{ $horario->quinto }}</td>
                                            <td>{{ $horario->sexto }}</td>
                                            <td>{{ $horario->septimo }}</td>
                                            <td>{{ $horario->octavo }}</td>
                                            <td>{{ $horario->noveno }}</td>
                                            <td>{{ $horario->decimo }}</td>
                                            <td>{{ $horario->once }}</td>
                                            <td>{{ $horario->doce }}</td>
                                            <td>{{ $horario->trece }}</td>
                                            <td>{{ $horario->catorce }}</td>
                                            <td>{{ $horario->quince }}</td>
                                            <td>{{ $horario->dieciseis }}</td>
                                            <td>{{ $horario->diecisiete }}</td>
                                            <td>{{ $horario->diesocho }}</td>
                                            <td>{{ $horario->diecinueve }}</td>
                                            <td>{{ $horario->veinte }}</td>
                                            <td>{{ $horario->veintiuno }}</td>
                                            <td>{{ $horario->veintidos }}</td>
                                            <td>{{ $horario->veintitres }}</td>
                                            <td>{{ $horario->veinticuatro }}</td>
                                            <td>{{ $horario->veinticinco }}</td>
                                            <td>{{ $horario->veintiseis }}</td>
                                            <td>{{ $horario->veintisiete }}</td>
                                            <td>{{ $horario->veintiocho }}</td>
                                            <td>{{ $horario->veintinueve }}</td>
                                            <td>{{ $horario->treinta }}</td>
                                            <td>{{ $horario->treintayuno }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



<!-- Esta tabla fue extraida de https://getbootstrap.com/docs/4.4/content/tables/ -->
<!-- Información de los data table aquí https://datatables.net/manual/styling/ -->