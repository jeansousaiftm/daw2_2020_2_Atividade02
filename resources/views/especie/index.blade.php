@extends("template.app")

@section("nome_tela", "Espécie")

@section("cadastro")
	<form action="/especie" method="POST" class="row">
		<div class="form-group col-6">
			<label>Descrição:</label>
			<input type="text" name="descricao" value="{{ $especie->descricao }}" class="form-control" required />
		</div>
		<div class="form-group col-6">
			@csrf
			<input type="hidden" name="id" value="{{ $especie->id }}" />
			<button class="btn btn-success bottom" type="submit">
				<i class="fa fa-save"></i> Salvar
			</button>
			<a href="/especie" class="btn btn-primary bottom">
				<i class="fa fa-plus"></i> Novo
			</a>
		</div>
	</form>
@endsection

@section("listagem")
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Descrição</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($especies as $especie)
				<tr>
					<td>{{ $especie->descricao }}</td>
					<td>
						<a href="/especie/{{ $especie->id }}/edit" class="btn btn-warning">
							<i class="fa fa-edit"></i> Editar
						</a>
					</td>
					<td>
						<form action="/especie/{{ $especie->id }}" method="POST">
							@csrf
							<input type="hidden" name="_method" value="delete" />
							<button class="btn btn-danger" type="submit" onclick="return confirm('Deseja realmente excluir?');">
								<i class="fa fa-trash"></i> Excluir
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection