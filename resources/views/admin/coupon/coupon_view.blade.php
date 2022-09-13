@extends('admin.admin_master')
@section('admin')

	@php
		\Carbon\Carbon::setLocale('fr');
	@endphp

	<div class="container-full">
		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			<div class="col-12">
				<div class="box">
					<div class="box-header">						
						<h4 class="box-title">Catégories</h4>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="complex_header" class="table table-striped table-bordered display" style="width:100%">
								<thead>
									<tr>
										<th>Nom</th>
										<th>Discount</th>
										<th>Date de fin de validité</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>	
                                    @foreach($allCoupons as $item)
                                        <tr>
                                            <td>{{ $item->coupon_name }}</td>
											<td>{{ $item->coupon_discount }}</td>
											<td>
												{{ Carbon\Carbon::parse($item->coupon_validity)->translatedFormat('d F Y') }}
											</td>
											<td>
												@if($item->coupon_validity <= Carbon\Carbon::now()->format('Y-m-d'))
													<span class="badge badge-pill badge-success">Valide</span>
												@else
													<span class="badge badge-pill badge-danger">Invalide</span>
												@endif
											</td>
											<td>
												<div>
												<a href="{{ route('admin.coupon.edit', $item->id) }}" class="btn btn-danger btn-md" style="background-color: purple!important; border: none; margin-right: 3px;"><i class="fas fa-edit" style="height: 22px;"></i></a>
													<a href="{{ route('admin.coupon.delete', $item->id) }}" id="delete" class="btn btn-danger btn-md" ><i class="fas fa-trash-alt" style="height: 20px;"></i></a>
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