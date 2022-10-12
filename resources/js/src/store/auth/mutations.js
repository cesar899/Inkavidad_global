export function setToken(state, payload) {
    localStorage.setItem('jwt', JSON.stringify(payload));
    state.token = payload
}
export function setRole(state, payload) {
    localStorage.setItem('role', JSON.stringify(payload));
    state.role = payload
}