export default {
    token: localStorage.getItem('jwt') != null ? JSON.parse(localStorage.getItem('jwt')) : null,
    role: localStorage.getItem('role') != null ? JSON.parse(localStorage.getItem('role')) : null,
    user: localStorage.getItem('userData') != null ? JSON.parse(localStorage.getItem('userData')) : null
}