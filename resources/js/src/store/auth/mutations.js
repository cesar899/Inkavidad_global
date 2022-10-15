export function setToken(state, payload) {
    localStorage.setItem('jwt', JSON.stringify(payload));
    state.token = payload
}
export function setRole(state, payload) {
    localStorage.setItem('role', JSON.stringify(payload));
    state.role = payload
}
export function setUser(state, payload) {
    localStorage.setItem('userData', JSON.stringify(payload));
    state.user = payload
}