@extends('layouts.dashboard')
@section('aside')
    <livewire:mostrar-aside></livewire:mostrar-aside>
@endsection
@section('contenido')
    <livewire:mostrar-informacion :user="$user"></livewire:mostrar-informacion>
@endsection