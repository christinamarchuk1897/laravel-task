export default {
    async fetchMessage({commit, state}, id) {

        await this.$axios.get(`/chat/${id}/messages`).then(({data})=> {
            const result = data.data;
            commit('setMessages', { ...result });
        }).catch(({response})=>{
            alert(response.data.message)
            console.log(response);
        });
    },

    async sentMessage({commit, state}, payload) {
        const { id, message } = payload;
        await this.$axios.post(`/chat/${id}/messages`, { message }).catch(({response})=>{
            alert(response.data.message)
            console.log(response);
        });
    },

    async fetchLatestMessage({commit, state}, id) {
        await this.$axios.get(`/chat/latest/${id}`).then(({data}) => {
            commit('setLastestMessages', data)
        }).catch(({response})=>{
            alert(response.data.message)
            console.log(response);
        });
    },
}
