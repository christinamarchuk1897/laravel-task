export default {
    async getUsers({commit, state}) {
        await this.$axios.get('/user/all').then(({data})=> {
            commit('setUsers', data);
        }).catch(({response})=>{
            alert(response.data.message)
            console.log(response);
        });
    },

    async addContact({commit, state}, id) {
        await this.$axios.post('/user/contact/add', { contact_id: id }).then(({data})=> {
            commit('setUsers', data.data)
        }).catch(({response})=>{
            alert(response.data.message)
            console.log(response);
        });
    },

    async removeContact({commit, state}, id) {
        await this.$axios.post('/user/contact/remove', { contact_id: id }).then(({data})=> {
            commit('setUsers', data.data)
        }).catch(({response})=>{
            alert(response.data.message)
            console.log(response);
        });
    },
}
