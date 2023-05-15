export default {
    async register({commit, state}, payload) {
        await this.$axios.get('/sanctum/csrf-cookie');
        await this.$axios.post('/register', payload).then(() =>{
            alert('Verification link has been sended to your email.');
            this.$router.push('login');
        }).catch(({response}) => {
            if(response.status === 422){
                commit('setValidationErrors', response.data.errors);
            } else {
                commit('setValidationErrors', {});
                alert(response.data.message)
            }
        });
    },

    async login({ commit, state, dispatch }, payload) {
        await this.$axios.get('/sanctum/csrf-cookie');
        await this.$axios.post('/login', payload).then((data)=>{
            dispatch('signIn');
        }).catch(({response})=>{
            if(response.status === 422){
                commit('setValidationErrors', response.data.errors);
            } else {
                commit('setValidationErrors', {});
                alert(response.data.message)
            }
        })
    },

    async signIn({ commit }){
        await this.$axios.get('/user').then((res) =>{
            commit('setUser', { ...res.data });
            commit('setAauthenticated', true);
            this.$router.push('/dashboard');
        }).catch((response)=>{
            commit('setUser', {});
            commit('setAauthenticated',false);
        })
    },

    async logout({commit}, payload) {
        await this.$axios.post('/logout').then(()=>{
            commit('setUser', {});
            commit('setAauthenticated', false);
            this.$router.push('login');
        })
    },

    async sentEmail({commit}, payload) {
        await this.$axios.post('/forgot-password', { email: payload }).then((data) =>{
            alert('Reset password link has been sended to your email.');
            this.$router.push('login');
        }).catch(({response})=>{
            alert(response.data.message)
            console.log(response);
        });
    },

    async reset({commit}, payload) {
        await this.$axios.post('/reset-password', payload).then(()=>{
            this.$router.push('login');
        }).catch(({response})=>{
            if(response.status === 422){
                commit('setValidationErrors', response.data.errors);
            } else {
                commit('setValidationErrors', {});
                alert(response.data.message)
            }
        });
    }
}
