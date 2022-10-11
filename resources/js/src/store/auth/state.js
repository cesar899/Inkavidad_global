export default {
    token: JSON.parse(window.localStorage.getItem('jwt')),
    role: JSON.parse(window.localStorage.getItem('rol'))
}