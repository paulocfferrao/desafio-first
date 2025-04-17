@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastro de Usuário</h1>
    
    <form id="registerForm">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <div id="nameError" class="text-danger"></div>
        </div>
        
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div id="emailError" class="text-danger"></div>
        </div>
        
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div id="passwordError" class="text-danger"></div>
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Confirmar Senha:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
    
    <div id="successMessage" class="alert alert-success mt-3" style="display:none;"></div>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Limpa mensagens de erro anteriores
    document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');
    document.getElementById('successMessage').style.display = 'none';
    
    fetch('/api/usuario', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify({
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmation').value
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('successMessage').textContent = data.message;
            document.getElementById('successMessage').style.display = 'block';
            document.getElementById('registerForm').reset();
            
            // Atualiza a lista de usuários
            window.location.href = '/usuario';
        } else {
            if (data.errors) {
                for (const [key, value] of Object.entries(data.errors)) {
                    document.getElementById(`${key}Error`).textContent = value[0];
                }
            } else {
                alert(data.message);
            }
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>
@endsection