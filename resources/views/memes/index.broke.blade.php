@extends('layouts.app')

@section('title','All Memes')
@section('content')
    <div>
        <div id="meme-search-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <ol class="carousel-indicators">
                    @for ($i = 0; $i < count($memes); $i++)
                        @if ($i == 0)
                            <li data-target="#meme-search-carousel" data-slide-to={{$i}} class="active"></li>
                        @else
                            <li data-target="#meme-search-carousel" data-slide-to={{$i}}></li>
                        @endif
                    @endfor
                </ol>
                @php
                    {{ $count = 0; }}
                @endphp
                @foreach ($memes as $meme)
                    <div>
                        
                        @if ($count == 0)
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="storage/memes/{{$meme->img}}" alt="Meme Stream">
                            </div>
                            @php
                                {{$count++;}}
                            @endphp
                        @else
                            <div class="carousel-item">
                                <img class="d-block w-100" src="storage/memes/{{$meme->img}}" alt="Meme Stream">
                            </div>
                        @endif
                    </div>
                @endforeach
                <a class="carousel-control-prev" href="#meme-search-carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#meme-search-carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    
    <h1>All Memes</h1>
    
    @if(count($memes) > 0)
        <div class="card-columns">
            @foreach($memes as $meme)
                @include('memes.show')
            @endforeach
        </div>
    @else
        <h3>There Are No Memes!</h3>
    @endif
    <hr>
    <div>
        <a href="memes/create"class="btn btn-primary">Create Meme</a>
    </div>
@endsection