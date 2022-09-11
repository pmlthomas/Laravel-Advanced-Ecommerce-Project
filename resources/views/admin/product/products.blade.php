@extends('admin.admin_master')
@section('admin')

<div class="container-full">
		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			<div class="col-12">
				<div class="box">
					<div class="box-header">						
						<h4 class="box-title">Produits</h4>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="complex_header" class="table table-striped table-bordered display" style="width:100%">
								<thead>
									<tr>
										<th>Image</th>
										<th>Nom fr</th>
										<th>Prix</th>
										<th>Quantité</th>
										<th>Discount</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>	
                                    @foreach($allProducts as $item)
                                        <tr>
											<td><img src="{{ asset($item->product_image) }}" style="height: 80px; max-width: 120px"></td>
                                            <td>{{ $item->product_name_fr }}</td>
                                            <td>{{ $item->product_selling_price }} €</td>
											<td>{{ $item->product_quantity }}</td>
											<td>
												@if ($item->product_discount_price == null)
													<span class="badge badge-pill badge-danger">No Discount</span>
												@else	
													@php
														$amount = intval($item->product_selling_price) - intval($item->product_discount_price);
														$discount = ($amount / intval($item->product_selling_price)) * 100;
													@endphp
													<span class="badge badge-pill badge-danger">{{ round($discount) }} %</span>
												@endif
											</td>
											<td>
												@if ($item->status == 1)
													<span class="badge badge-pill badge-success">Actif</span>
												@else
													<span class="badge badge-pill badge-danger">Inactif</span>
												@endif
											</td>
											<td>
												<div style="display: flex;">
													@if ($item->status == 1)
														<a href="{{ route('admin.product.inactive', $item->id) }}" class="btn btn-danger btn-md" style="background-color: green!important; border: none; margin-right: 7px;"><i class="fas fa-regular fa-toggle-on"></i></a>
													@else
														<a href="{{ route('admin.product.active', $item->id) }}" class="btn btn-danger btn-md" style="background-color: red!important; border: none; margin-right: 7px;"><i class="fas fa-regular fa-toggle-on"></i></a>
													@endif
													<a href="{{ route('admin.product.edit', $item->id) }}" class="btn btn-danger btn-md" style="background-color: purple!important; border: none; margin-right: 7px;"><i class="fas fa-edit" style="height: 22px;"></i></a>
													<a href="{{ route('admin.product.delete', $item->id) }}" id="delete" class="btn btn-danger btn-md" ><i class="fas fa-trash-alt" style="height: 20px;"></i></a>
												</div>
											</td>
                                        </tr>
                                    @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

@endsection