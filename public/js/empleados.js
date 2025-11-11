if (!getToken()){
    window.location.href = 'index.html'
}

let editingId = null

const $tbody = document.querySelector("#tableEmpleados tbody")
const $btnGuardar = document.getElementById("btnGuardar")
const $btnActualizar = document.getElementById("btnActualizar")
const $btnCancelar = document.getElementById("btnCancelar")
const $msg = document.getElementById("forMsg")

const readForm = () => {
    return {
        nombre: document.getElementById('nombre').value,
        apaterno: document.getElementById('apaterno').value,
        amaterno: document.getElementById('amamtero').value,
        usuario: document.getElementById('usuario').value,
        password: document.getElementById('password').value,
        rol: document.getElementById('rol').value,
        telefono: document.getElementById('telefono').value,
        ciudad: document.getElementById('ciudad').value,
        estado: document.getElementById('estado').value,
        direccion: document.getElementById('direccion').value
    }
}

const fillForm = emp => {
    document.getElementById('nombre').value = emp.nombre || ''
    document.getElementById('apaterno').value = emp.apaterno || ''
    document.getElementById('amaterno').value = emp.amaterno || ''
    document.getElementById('usuario').value = emp.usuario || ''
    document.getElementById('password').value = emp.password || ''
    document.getElementById('rol').value = emp.rol || ''
    document.getElementById('telefono').value = emp.telefono || ''
    document.getElementById('ciudad').value = emp.ciudad || ''   
    document.getElementById('estado').value = emp.estado || ''
    document.getElementById('direccion').value = emp.direccion || ''
}

const clearForm = () => {
    fillForm({})
}

const setCreateMode = () => {
    editingId = null
    $btnGuardar.classList.remove('d-none')
    $btnActualizar.classList.add('d-none')
    $btnCancelar.classList.add('d-none')
    clearForm()
    $msg.textContent = '' 
}

const setEditingMode = emp => {
    editingId = emp.id
    fillForm(emp)
    $btnGuardar.classList.add('d-none')
    $btnActualizar.classList.remove('d-none')
    $btnCancelar.classList.remove('d-none')
    $msg.textContent = '' 
}

const fetchEmpleados = async () => {
    $tbody.innerHTML = `
    <tr>
        <td colspan="7">Cargando ... </td>
    </tr>
    `

    const res = await fetch(API_BASE + 'api/empleados', {
        headers: {
            "Authorization": "Bearer " + getToken()
        }
    })
    const j =await res.json()
    console.log('@@@ j => ',j)
}

fetchEmpleados()