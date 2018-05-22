@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>NILAI NAMA MAHASISWA</h2>
            </div>
        </div>
    </div>

    <!-- Dropdown Trigger -->
    <a class='dropdown-trigger btn' href='#' data-target='dropdown'>SEMESTER 1</a>

    <!-- Dropdown Structure -->
    <ul id='dropdown' class='dropdown-content'>
        <li><a href="#!">one</a></li>
        <li><a href="#!">two</a></li>
        <li class="divider" tabindex="-1"></li>
        <li><a href="#!">three</a></li>
        <li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
        <li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
    </ul>


    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif

    <table class="bordered">
        <tr>
            <th>No</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Tugas</th>
            <th>Formatif</th>
            <th>UTS</th>
            <th>UAS</th>
            <th>Nilai</th>
        </tr>
        @foreach($nilais as $nilai)
            <tr>
                <td>{{$nilai->id}}</td>
                <td>{{$nilai->sks}}</td>
                <td>{{$nilai->sks}}</td>
                <td>{{$nilai->tugas}}</td>
                <td>{{$nilai->formatif}}</td>
                <td>{{$nilai->uts}}</td>
                <td>{{$nilai->uas}}</td>
                <td>{{$nilai->uas}}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('admin.edit',$nilai->id) }}">SUNTING NILAI</a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection