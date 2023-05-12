import state from "./state";

export default {
    getUser(state) {
        return state.user;
    },
    getValidationErrors(state) {
        return state.validationErrors;
    },
    getAuthenticated(state) {
        return state.authenticated;
    },
}
