export default {
    setUser(state, data) {
        state.user = data;
    },
    setValidationErrors(state, data) {
        state.validationErrors = data;
    },
    setAauthenticated (state, value) {
        state.authenticated = value;
    },
}
