@extends('frontend.main_master')
@section('content')

    <div class="table-responsive" style="margin-left: 70px; margin-right: 50px; padding-top: 15px; padding-bottom: 5px;">
        <h4>Détails de la commande</h4>        
        <table id="complex_header" class="table table-striped table-bordered display" style="width:100%;">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Prix Total</th>
                    <th>Addresse de Livraison</th>
                    <th>Numéro de la Commande</th>
                    <th>État de la Commande</th>
                </tr>
            </thead>
            <tbody>	
                <tr>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->total_price }} €</td>
                    <td>{{ $order->address }} {{ $order->city }}, {{ $order->country }}</td>
                    <td>{{ $order->invoice_number }}</td>
                    <td>
                        @if($order->status == 'Pending')
                            <span class="badge badge-pill badge-warning" style="background-color: grey;">En cours de traitement</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="table-responsive" style="margin-left: 70px; margin-right: 50px;">
        <h4>Produits commandés</h4>        
        <table id="complex_header" class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Couleur</th>
                    <th>Taille</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>	
                @foreach($order_items as $item)
                    @php
                        $ordered_product = App\Models\Product::where('id', $item->product_id)->get();
                    @endphp
                    <tr>
                        <td><img src="{{ asset($ordered_product[0]->product_image) }}" style="height: 90px; width: 100px;"></td>
                        <td>{{ $ordered_product[0]->product_name_fr }}</td>
                        <td>{{ $item->color }}</td>
                        <td>{{ $item->size }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($order->status !== 'Delivered')
        <div style="margin-top: 45px; margin-left: 70px; margin-right: 50px;">
            <h4>Annuler ma commande</h4>
            <form method="post" action="{{ route('cancel.order') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $order->id }}">
                <label for="cancel_raison" style="margin-top: 5px;">Raison de mon annulation</label>
                <textarea name="cancel_raison" class="form-control"></textarea>
                <button type="submit" class="btn btn-danger btn-md" style="margin-top: 10px;">Annuler ma commande</button>
            </form>
        </div>
    @endif

    <div style="display: flex; justify-content: flex-end; margin-right: 50px; margin-bottom: 40px;">
        <a href="{{ route('user.orders') }}"><button class="btn btn-warning btn-md">Revenir en arrière</button></a>
    </div>

@endsection