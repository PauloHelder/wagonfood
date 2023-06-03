@include('admin.includes.alerts')
<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{$plan->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="price">Preço:</label>
    <input type="number" name="price" class="form-control" placeholder="Preço" value="{{$plan->price ?? old('price')}}">
</div>
<div class="form-group">
    <label for="namme">Descrição:</label>
    <textarea class="form-control" name="description" placeholder="Descrição">{{$plan->description ?? old('description')}}</textarea>
</div>
<button class="btn btn-info">Salvar</button>