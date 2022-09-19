<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Facture</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: green;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: green;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <!-- {{-- <img src="" alt="" width="150"/> --}} -->
          <h2 style="color: green; font-size: 26px;"><strong>Pml_boutique</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
                Pml_boutique
                Email: pmlthomaspro@gmail.com <br> 
            </pre>
        </td>
    </tr>

  </table>

  <table width="100%" style="background:white; padding:2px;"></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
           <strong>Nom:</strong> {{ $order->name }} <br>
           <strong>Email:</strong> {{ $order->email }} <br>
           <strong>Numéro de téléphone:</strong> {{ $order->phone }} <br>
            
           <strong>Addresse:</strong> {{ $order->address }} {{ $order->city }}, {{ $order->country }} <br>
         </p>
        </td>
        <td>
          <p class="font" style="margin-top: -20px;">
            <h3><span style="color: green;">Numéro de commande:</span> #{{ $order->invoice_number }}</h3>
            Date de commande: Order Date <br>
            Type de payment : Carte bancaire </span>
         </p>
        </td>
    </tr>
  </table>
  <br/>
<h3>Produits</h3>


  <table width="100%">
    <thead style="background-color: green; color:#FFFFFF;">
      <tr class="font">
        <th>Image</th>
        <th>Nom</th>
        <th>Taille</th>
        <th>Couleur</th>
        <th>Quantité</th>
        <th>Prix à l'unité</th>
        <th>Prix total</th>
      </tr>
    </thead>
    <tbody>

      @php
        $total_price = 0;
      @endphp

      @foreach($order_items as $item)
        @php
            $ordered_product = App\Models\Product::where('id', $item->product_id)->get();
        @endphp
        <tr class="font">
            <td align="center"><img src="{{ public_path($ordered_product[0]->product_image) }}" style="height: 60px; width: 70px;"></td>
            <td align="center">{{ $ordered_product[0]->product_name_fr }}</td>
            <td align="center">{{ $item->color }}</td>
            <td align="center">{{ $item->size }}</td>
            <td align="center">{{ $item->quantity }}</td>
            <td align="center">{{ $item->price }} €</td>
            <td align="center">{{ $item->quantity * $item->price }} €</td>

            @php
              $total_price += ($item->quantity * $item->price);
            @endphp
        </tr>
      @endforeach
      
    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2><span style="color: green;">Sous-total:</span> {{ $total_price }} €</h2>
            <h2><span style="color: green;">Total:</span> {{ $order->total_price }} €</h2>
            {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
        </td>
    </tr>
  </table>
  <div class="thanks mt-3">
    <p>Encore merci pour votre achat!</p>
  </div>
  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Votre signature:</h5>
    </div>
</body>
</html>