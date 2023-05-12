<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Dashboard</h3>
                    </div>
                    <Stats :user="user"/>
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
export default {
    name:"dashboard",
    components: {
        Contacts,
        Stats
    },
    data() {
        return {
            user: {},
            users: [],
        }
    },
    computed: {
        getUser() {
            return this.$store.getters['auth/getUser'];
        },
        getAllUsers() {
            return this.$store.getters['user/getUsers'];
        },
        hasData() {
            return (this.user && this.user.contacts && this.user.contacts.length) && this.users.length;
        }
    },

    mounted() {
        this.getData();
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
                    this.users = data.filter((el) =>{
                        if (el.id !== this.user.id) {
                            return el;
                        }
                    });
                }
            },
            deep: true
        },
        hasData(data) {
            if (data) {
                this.renderData();
            }
        }
    },

    methods: {
        getData() {
            this.$store.dispatch('auth/signIn');
            this.$store.dispatch('user/getUsers');
        },
        renderData() {
            let ids = this.user.contacts.map((el) => el.id);
            this.users = this.users.filter((el) => {
                if (!ids.includes(el.id)) {
                    return el;
                }
            });
        }
    },
}
</script>