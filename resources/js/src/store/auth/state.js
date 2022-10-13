export default {
    token: localStorage.getItem('jwt') != null ? JSON.parse(localStorage.getItem('jwt')) : null,
    role: localStorage.getItem('role') != null ? JSON.parse(localStorage.getItem('role')) : null
}