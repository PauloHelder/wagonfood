@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{$profile->name ?? old('name')}}">
</div>

<div class="form-group">
    <label for="namme">Descrição:</label>
    <textarea class="form-control" name="description" placeholder="Descrição">{{$profile->description ?? old('description')}}</textarea>
</div>
<button class="btn btn-info">Salvar</button>