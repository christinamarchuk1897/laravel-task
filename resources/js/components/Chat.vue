<template>
    <div class="container">
        <button class="btn btn-primary btn-msg">
            <router-link :to="'/dashboard'">
                Back
            </router-link>
        </button>
        <div class="card">
            <div class="card-header">Chats</div>
            <div class="card-body">
                <ul class="chat">
                    <li class="chat-elem" v-for="(data) in messages" :key="data.id" :class="{'end': user.id === data.user.id}">
                        <div class="clearfix">
                            <div class="header">
                                <strong>
                                    {{ data.user.name }}
                                </strong>
                            </div>
                            <p>
                                {{ data.message }}
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                <div class="input-group">
                    <input
                    id="btn-input"
                    type="text"
                    name="message"
                    class="form-control input-sm"
                    placeholder="Type your message here..."
                    v-model="newMessage"
                    @keyup.enter="sendMessage" />
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                            Sent
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: this.$store.getters['auth/getUser'].data,
            contact_id: this.$route.params.id,
            newMessage: "",
            messages: []
        };
    },
    computed: {
        getUser() {
            return this.$store.getters['auth/getUser'];
        },
        getMessages() {
            return this.$store.getters['chat/getMessages'];
        }
    },
    watch: {
        getMessages: {
            handler(data) {
                if (data) {
                    this.messages = data.messages;
                }
            },
            deep: true
        },
    },
    mounted() {
        this.fetchMessage(this.contact_id);
        window.Echo.private('chat').listen('MessageSent', (e) => {
            this.messages.push({
                message: e.message.message,
                user: e.user
            });
        });
    },
    methods: {
        async fetchMessage(id) {
            this.$store.dispatch('chat/fetchMessage', id);
        },
        async sendMessage() {
            const newMsg = {
                message: this.newMessage,
                user: this.user
            }
            await this.$store.dispatch('chat/sentMessage', { id: this.contact_id, message: this.newMessage });
            this.messages.push(newMsg);
            this.newMessage = "";
        },
    },
};
</script>
<style lang="scss">
.chat {
    .chat-elem {
        list-style-type: none;
        padding: 0;
        margin: 0;
        &.end {
            text-align: end;
        }
    }
}
.btn-msg {
    a {
        color: #fff;
        text-decoration: none;
    }
}
</style>