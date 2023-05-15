<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Dashboard</h3>
                    </div>
                    <Stats :user="user"/>
                    <Messages :latest="latestMessages"/>
                    <Contacts :users="users"
                              :user="user"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Contacts from "./Contacts.vue";
import Stats from "./Stats.vue";
import Messages from "./Messages.vue";
export default {
    name:"dashboard",
    components: {
        Contacts,
        Stats,
        Messages
    },
    data() {
        return {
            user: {},
            users: [],
            latestMessages: {}
        }
    },
    computed: {
        getUser() {
            return this.$store.getters['auth/getUser'];
        },
        getAllUsers() {
            return this.$store.getters['user/getUsers'];
        },
        getLatestMessages() {
            return this.$store.getters['chat/getLatestMessage'];
        }
    },

    mounted() {
        this.getData();
        this.fetchUnreadMessage();
    },

    watch: {
        getUser: {
            handler(data) {
                if (data) {
                    this.user = data.data;
                }
            },
            deep: true
        },
        getAllUsers: {
            handler(data) {
                if (data) {
                    this.renderData(data);
                }
            },
            deep: true
        },
        getLatestMessages: {
            handler(data) {
                if (data) {
                    this.latestMessages = data;
                }
            },
            deep: true
        }
    },

    methods: {
        renderData(data) {
            let ids = this.user.contacts.map((el) => el.id);
            this.users = data.filter((el) => {
                if (!ids.includes(el.id)) {
                    return el;
                }
            });
        },
        getData() {
            this.$store.dispatch('auth/signIn');
            this.$store.dispatch('user/getUsers');
        },
        async fetchUnreadMessage() {
            await this.$store.dispatch('chat/fetchLatestMessage', this.getUser.data.id);
        }
    },
}
</script>
<style lang="scss">
    .bold {
        font-weight: 600;
    }
    .btn {
        margin-right: 10px
    }
    .card-subtitle {
        margin-bottom: 20px;
    }
    .card-title {
        font-size: 18px;
    }
    .card-content {
        border-top: 1px solid grey;
        border-bottom: 1px solid grey;
        margin-bottom: 15px;
        padding: 10px;
    }
</style>