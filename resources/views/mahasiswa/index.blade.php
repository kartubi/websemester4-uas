@extends('master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{$info->name}}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>NILAI {{strtoupper($info->name)}}</h2>
            </div>
        </div>
    </div>

    <!-- Dropdown Trigger -->
    <a class='dropdown-trigger btn' id="smt_trigger" href='#' data-target='dropdown1'>SEMESTER</a>
    <!-- Dropdown Structure -->
    <ul id='dropdown1' class='dropdown-content'>
        @foreach($semester as $smt)
            <li style="white-space: nowrap"><a id="{{$smt->id}}">{{strtoupper($smt->name)}}</a></li>
        @endforeach
    </ul>

    <table class="bordered">
        <tr>
            <th>No</th>
            <th>Kode barang</th>
            <th>Nama barang</th>
            <th>Harga</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        @foreach($barangs as $barang)
            <tr>
                <td>{{$barang->id}}</td>
                <td>{{$barang->code}}</td>
                <td>{{$barang->name}}</td>
                <td>{{$barang->price}}</td>
                <td>{{$barang->qty}}</td>
                <td>{{$barang->qty * $barang->price}}</td>
                <td>

                    <a class="btn btn-primary" href="{{ route('barang.edit',$barang->id) }}">Edit</a>

                    {!! Form::open(['method' => 'DELETE','route' => ['barang.destroy', $barang->id],'style'=>'display:inline']) !!}

                    {!! Form::submit('Delete', ['class' => 'btn btn-danger red']) !!}

                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    {!! $barangs->links() !!}

@endsection