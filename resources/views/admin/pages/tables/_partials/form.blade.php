@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="name">Identify:</label>
    <input type="text" name="identify" class="form-control" placeholder="Nome" value="{{$table->identify ?? old('identify')}}">
</div>

<div class="form-group">
    <label for="Descrição">Descrição:</label>
    <textarea name="desciption" class="form-control" placeholder="Descrição">{{$table->desciption ?? old('desciption')}}</textarea>
</div>


<button class="btn btn-info">Salvar</button>