@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{$user->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="name">Email:</label>
    <input type="email" name="email" class="form-control" placeholder="Nome" value="{{$user->email ?? old('email')}}">
</div>
<div class="form-group">
    <label for="Password">Password:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha" value="">
</div>


<button class="btn btn-info">Salvar</button>