@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="image">* Image:</label>
    <input type="file" name="image" class="form-control" placeholder="Image" value="{{$product->title ?? old('title')}}">
</div>
<div class="form-group">
    <label for="name">* Nome:</label>
    <input type="text" name="title" class="form-control" placeholder="Nome" value="{{$product->title ?? old('title')}}">
</div>
<div class="form-group">
    <label for="Preco">*Preço:</label>
    <input type="text" name="price" class="form-control" placeholder="Preço" value="{{$product->price ?? old('price')}}">
</div>

<div class="form-group">
    <label for="Descrição">* Descrição:</label>
    <textarea name="description" class="form-control" placeholder="Descrição">{{$product->description ?? old('description')}}</textarea>
</div>


<button class="btn btn-info">Salvar</button>