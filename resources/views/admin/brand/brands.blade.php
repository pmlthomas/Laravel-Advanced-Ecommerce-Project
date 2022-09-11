@extends('admin.admin_master')
@section('admin')

<div class="container-full">
		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			<div class="col-12">
				<div class="box">
					<div class="box-header">						
						<h4 class="box-title">Marques</h4>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="complex_header" class="table table-striped table-bordered display" style="width:100%">
								<thead>
									<tr>
										<th>Numéro de la marque</th>
										<th>Nom</th>
										<th>Image</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>	
                                    @foreach($allBrands as $key => $item)
                                        <tr>
											<td>{{ $key + 1 }}</td>
                                            <td>{{ $item->brand_name_fr }}</td>
											<td><img src="{{ asset($item->brand_image) }}" style="height: 50px; width: 70px;"></td>
											<td>
												<div>
													<a href="{{ route('admin.brand.delete', $item->id) }}" id="delete" class="btn btn-danger btn-md" ><i class="fas fa-trash-alt" style="height: 20px;"></i></a>
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