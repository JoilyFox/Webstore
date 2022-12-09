@extends('layouts.main')

{{-- Title --}}
@section('title', 'Home')

{{-- CSS --}}
@section('css')
<link rel="stylesheet" href="css/welcome-page.css">
@endsection

{{-- Content --}}
@section('content')

    @if (session()->has('success_message'))
        <style>
            body {
                overflow: hidden; 
                margin-right: 17px;
            }
            @media screen and (max-width: 500px) {
                body {
                    margin-right: 0;
                }
            }
        </style>
        <div class="mainModal">
            <div class="modal">
                <h4 class="caption">Success!</h4>
                <span class="text">{{ session()->get('success_message') }}</span>
                <span class="cross closeMainModal"><img src="/assets/icons/cross.svg" alt="Close"></span>
            </div>
            <div class="overlay closeMainModal"></div>
        </div>
    @endif
    
    @if (session()->has('error_message'))
        <style>
            body {
                overflow: hidden; 
                margin-right: 17px;
            }
            @media screen and (max-width: 500px) {
                body {
                    margin-right: 0;
                }
            }
        </style>
        <div class="mainModal">
            <div class="modal">
                <h4 class="caption">Error!</h4>
                <span class="text">{{ session()->get('error_message') }}</span>
                <span class="cross closeMainModal"><img src="/assets/icons/cross.svg" alt="Close"></span>
            </div>
            <div class="overlay closeMainModal"></div>
        </div>
    @endif

    <div class="imageBtns">
        <a href="{{route('getProductsByCategory', ['clothes', 't-shirts'])}}" class="btn">
            <h3>T-Shirts</h3>
            <img loading="lazy" src="/assets/img/welcome-page/D_slide_man_novedades.jpg" alt="New clothes">
        </a>

        <a href="{{route('getProductsByCategory', ['clothes', 'sweatshirts'])}}" class="btn">
            <h3>Sweatshirts</h3>
            <img loading="lazy" src="/assets/img/welcome-page/D_slide_man_sudaderas.jpg" alt="Sweatshirts">
        </a>
        <a href="{{route('getProductsByCategory', ['clothes', 'jeans'])}}" class="btn">
            <h3>Jeans</h3>
            <img loading="lazy" src="/assets/img/welcome-page/D_slide_man_jeans.jpg" alt="Jeans">
        </a>
    </div>

@endsection