import { createStore } from "vuex";
import createPersistedState from 'vuex-persistedstate'
import user from "./user/index.js";
import auth from "./auth/index.js";

const store = createStore({
    plugins: [
        createPersistedState()
    ],
    modules: {
        user,
        auth
    }
});

export default store;
