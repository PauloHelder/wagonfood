@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{$category->name ?? old('name')}}">
</div>

<div class="form-group">
    <label for="Descrição">Descrição:</label>
    <textarea name="description" class="form-control" placeholder="Descrição">{{$category->description ?? old('description')}}</textarea>
</div>


<button class="btn btn-info">Salvar</button>