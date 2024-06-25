

// Criar Usuário
document.getElementById('createUserForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    let formData = new FormData(this);
    fetch('http://localhost/api/users/create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(data => {
        const messageContainer = document.getElementById('createUserMessage');
        messageContainer.style.display = 'block';
        if (data.error) {
            messageContainer.className = 'message error';
            if (data.error === true) {
                messageContainer.textContent = 'Email já cadastrado.';
            } else {
                messageContainer.textContent = data.error || 'Erro ao criar usuário.';
            }
        } else {
            messageContainer.className = 'message success';
            messageContainer.textContent = data.message || 'Criado com sucesso!';
        }
    })
    .catch(error => console.error('Erro:', error));
});

// Login de Usuário
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    
    fetch('http://localhost/api/users/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email, password })
    })
    .then(response => response.json())
    .then(data => {
        const messageContainer = document.getElementById('loginMessage');
        messageContainer.style.display = 'block';
        if (data.error) {
            messageContainer.className = 'message error';
            messageContainer.textContent = data.message || 'Erro ao fazer login.';
        } else {
            messageContainer.className = 'message success';
            messageContainer.textContent = 'Login bem-sucedido! Token: ' + data.jwt;
            // Salvar token em localStorage ou sessionStorage
            localStorage.setItem('token', data.jwt);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        const messageContainer = document.getElementById('loginMessage');
        messageContainer.style.display = 'block';
        messageContainer.className = 'message error';
        messageContainer.textContent = 'Erro ao conectar-se ao servidor.';
    });
});

// Buscar Informações do Usuário
document.getElementById('fetchUserForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const token = document.getElementById('fetchToken').value;
    
    fetch('http://localhost/api/users/fetch', {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => response.json())
    .then(data => {
        const messageContainer = document.getElementById('fetchUserMessage');
        messageContainer.style.display = 'block';
        if (data.error) {
            messageContainer.className = 'message error';
            messageContainer.textContent = data.message || 'Erro ao buscar informações.';
        } else {
            messageContainer.className = 'message success';
            messageContainer.textContent = JSON.stringify(data.data);
        }
    })
    .catch(error => console.error('Erro:', error));
});

// Atualizar Informações do Usuário
document.getElementById('updateUserForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    const name = formData.get('name');
    const token = document.getElementById('updateToken').value;
    
    fetch('http://localhost/api/users/update', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify({ name })
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        else {
            throw new Error('Erro ao atualizar usuário. Verifique o token.');
        }
    })
    .then(data => {
        const messageContainer = document.getElementById('updateUserMessage');
        messageContainer.style.display = 'block';
        if (data.error) {
            messageContainer.className = 'message error';
            messageContainer.textContent = data.message || 'Erro ao atualizar usuário.';
        } else {
            messageContainer.className = 'message success';
            messageContainer.textContent = data.message || 'Usuário atualizado com sucesso!';
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        const messageContainer = document.getElementById('updateUserMessage');
        messageContainer.style.display = 'block';
        messageContainer.className = 'message error';
        messageContainer.textContent = error.message || 'Erro ao conectar-se ao servidor.';
    });
});

// Deletar Usuário
document.getElementById('deleteUserForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const userId = document.getElementById('deleteUserId').value;
    const token = document.getElementById('deleteToken').value;
    
    fetch(`http://localhost/api/users/${userId}/delete`, {
        method: 'DELETE',
        headers: {
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }  else {
            throw new Error('Erro ao deletar usuário. Verifique o token ou id usuario.');
        }
    })
    .then(data => {
        const messageContainer = document.getElementById('deleteUserMessage');
        messageContainer.style.display = 'block';
        if (data.error) {
            messageContainer.className = 'message error';
            messageContainer.textContent = data.message || 'Erro ao deletar usuário.';
        } else {
            messageContainer.className = 'message success';
            messageContainer.textContent = data.message || 'Usuário deletado com sucesso!';
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        const messageContainer = document.getElementById('deleteUserMessage');
        messageContainer.style.display = 'block';
        messageContainer.className = 'message error';
        messageContainer.textContent = error.message || 'Erro ao conectar-se ao servidor.';
    });
});
