@extends('frontend.main_master')
@section('content')

    <style>
        #facture:hover {
            background-color: chocolate!important;
        }
    </style>

    <div class="table-responsive" style="margin-left: 70px; margin-right: 50px;">
        <table id="complex_header" class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Addresse de livraison</th>
                    <th>Numéro de la commande</th>
                    <th>État de la commande</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>	
                @foreach($orders as $item)
                    <tr>
                        <td>{{ $item->order_date }}</td>
                        <td>{{ $item->total_price }} €</td>
                        <td>{{ $item->address }} {{ $item->city }}, {{ $item->country }}</td>
                        <td>{{ $item->invoice_number }}</td>
                        <td>
                            @if($item->status == 'Pending')
                                <span class="badge badge-pill badge-warning" style="background-color: grey;">En cours de traitement</span>
                            @elseif($item->status == 'Canceled')
                                <span class="badge badge-pill badge-warning" style="background-color:firebrick;">Annulée</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('see.user.orders', $item->id) }}" class="btn btn-sm btn-primary" style="width: 90px;"><i class="fa fa-eye" style="margin-right: 3px;"></i> Voir</a>
                            <a href="{{ route('download.invoice', $item->id) }}" class="btn btn-sm btn-primary" id="facture" style="width: 90px; background-color: coral;"><i class="fa fa-download  "></i> Facture</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>

@endsection