const API_BASE = 'http://localhost:8888/proyecto-php-ad2025/backend'
console.log('@@ api base =>', API_BASE)

const saveToken = token => {
    localStorage.setItem('token', token)
}

const getToken = () => {
    return localStorage.getToken('token')
}

const clearToken = () => {
    localStorage.removeItem('token')
}

const btnLogin = document.getElementById('btnLogin')
if (btnLogin) {
    btnLogin.addEventListener('click', async () => {
        const usuario=document.getElementById('usuario').value
        const password=document.getElementById('password').value
        const msg = document.getElementById('loginMsg')

        msg.textContent = ''
        try {
            const res = await fetch(API_BASE +  'api/login', {
                method: 'POST',
                headers: {'Content-type': 'application/json'},
                body: JSON.stringify({ usuario, password})
            })
            const data = await res.json()
            if (!data.ok) {
                msg.textContent = data.message || 'Login Fallo'
            }
            saveToken(data.data.token)
            window.location.href = 'empleados.html'
        } catch (error) {
            msg.textContent = 'Error de red'
        }
    }) 
}

const btnLogout = document.getElementById('btnLogout')
if (btnLogout) {
    btnLogout.addEventListener('click', () => {
        clearToken()
        window.location.href = 'index.html'
    })
}