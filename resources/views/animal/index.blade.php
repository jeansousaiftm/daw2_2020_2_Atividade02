@extends("template.app")

@section("nome_tela", "Animal")

@section("cadastro")
	<form action="/animal" method="POST" class="row">
		<div class="form-group col-4">
			<label>Nome:</label>
			<input type="text" name="nome" value="{{ $animal->nome }}" class="form-control" required />
		</div>
		<div class="form-group col-4">
			<label>Dono:</label>
			<input type="text" name="dono" value="{{ $animal->dono }}" class="form-control" required />
		</div>
		<div class="form-group col-4">
			<label>Raça:</label>
			<input type="text" name="raca" value="{{ $animal->raca }}" class="form-control" required />
		</div>
		<div class="form-group col-4">
			<label>Espécie:</label>
			<select name="especie" class="form-control">
				<option value=""></option>
				@foreach ($especies as $especie)
					@if ($especie->id == $animal->especie)
						<option value="{{ $especie->id }}" selected="selected">{{ $especie->descricao }}</option>
					@else
						<option value="{{ $especie->id }}">{{ $especie->descricao }}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="form-group col-4">
			<label>Nascimento:</label>
			<input type="date" name="nascimento" value="{{ $animal->nascimento }}" class="form-control" required />
		</div>
		<div class="form-group col-4">
			@csrf
			<input type="hidden" name="id" value="{{ $animal->id }}" />
			<button class="btn btn-success bottom" type="submit">
				<i class="fa fa-save"></i> Salvar
			</button>
			<a href="/animal" class="btn btn-primary bottom">
				<i class="fa fa-plus"></i> Novo
			</a>
		</div>
	</form>
@endsection

@section("listagem")
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Idade</th>
				<th>Espécie</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($animais as $animal)
				<tr>
					<td>{{ $animal->nome }}</td>
					<td>{{ $animal->idade }}</td>
					<td>{{ $animal->especie }}</td>
					<td>
						<a href="/animal/{{ $animal->id }}/edit" class="btn btn-warning">
							<i class="fa fa-edit"></i> Editar
						</a>
					</td>
					<td>
						<form action="/animal/{{ $animal->id }}" method="POST">
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