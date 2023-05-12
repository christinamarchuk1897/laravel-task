export default {
    async getUsers({commit, state}) {
        await this.$axios.get('/user/all').then(({data})=> {
            commit('setUsers', data.users)
        });
    },

    async addContact({commit, state}, id) {
        await this.$axios.post('/user/contact/add', { contact_id: id }).then(({data})=> {
            commit('setUsers', data.data)
        });
    },

    async removeContact({commit, state}, id) {
        await this.$axios.post('/user/contact/remove', { contact_id: id }).then(({data})=> {
            commit('setUsers', data.data)
        });
    },
}
