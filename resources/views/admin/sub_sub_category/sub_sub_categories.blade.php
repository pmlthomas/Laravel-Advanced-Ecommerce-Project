@extends('admin.admin_master')
@section('admin')

<style>
	th {
		max-width: 90px;
		overflow: hidden;
	}
	td {
		max-width: 90px;
		overflow: hidden;
	}
</style>

<div class="container-full">
		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			<div class="col-12">
				<div class="box">
					<div class="box-header">						
						<h4 class="box-title">Sous-sous-catégories</h4>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="complex_header" class="table table-striped table-bordered display" style="width:100%">
								<thead>
									<tr>
										<th>Numéro</th>
										<th>Catégorie</th>
										<th>Sous-catégorie</th>
										<th>Nom Français</th>
										<th>Nom Anglais</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>	
                                    @foreach($allSubSubCategories as $key => $item)
                                        <tr>
											<td>{{ $key + 1 }}</td>
											<td>{{ $item['category']['category_name_fr'] }}</td>
											<td>{{ $item['sub_category']['sub_category_name_fr'] }}</td>
                                            <td>{{ $item->sub_sub_category_name_fr }}</td>
                                            <td>{{ $item->sub_sub_category_name_en }}</td>
											<td>
												<div>
													<a href="{{ route('admin.sub_sub_category.edit', $item->id) }}" class="btn btn-danger btn-md" style="background-color: purple!important; border: none; margin-right: 3px;"><i class="fas fa-edit" style="height: 22px;"></i></a>
													<a href="{{ route('admin.sub_sub_category.delete', $item->id) }}" id="delete" class="btn btn-danger btn-md" ><i class="fas fa-trash-alt" style="height: 20px;"></i></a>
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