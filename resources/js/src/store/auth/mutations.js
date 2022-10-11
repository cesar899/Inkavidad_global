export function setToken(state, payload) {
    state.token = localStorage.setItem('jwt', JSON.stringify(payload));
}
export function setRole(state, payload) {
    state.role = localStorage.setItem('role', JSON.stringify(payload));
}