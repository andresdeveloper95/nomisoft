@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
            
                <div class="card-header" style="font-family: cursive; font-size: 60px;" 
                style="color:#FF0000;"><center>Menú principal</center></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel"> 
                      <div class="carousel-inner">
                        <div class="carousel-item" data-interval="7000">
                            <!--<img src="..." class="d-block w-100" alt="...">-->
                            <img src="{{ asset('img/univalle4.jpeg') }}" style=" width: 500px; height: 500px; margin-left:100px">
                            </div>
                        <div class="carousel-item" data-interval="7000">
                          <!--<img src="..." class="d-block w-100" alt="..."> -->
                          <img src="{{ asset('img/univalle.jpg') }}" style=" width: 700px; height: 500px;">
                        </div>
                        <div class="carousel-item active" data-interval="7000">
                          <!--<img src="..." class="d-block w-100" alt="..."> -->
                          <img src="{{ asset('img/nuevounivalle.jpeg') }}"  class="row justify-content-center" style=" width: 700px; height: 500px;">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
