<template>
    <div>
        <div class="card-body">
            <h3 class="card-subtitle">My Contacts</h3>
            <div v-if="user && user.contacts && user.contacts.length">
                <div v-for="user in user.contacts" :key="user.id">
                    <div class="card-content">
                        <p class="card-title">{{ user.name }}</p>
                        <p class="card-title">{{ user.email }}</p>
                    </div>
                    <button class="btn btn-primary mr-2" @click="removeContact(user.id)">Remove</button>
                    <button class="btn btn-primary">
                        <router-link :to="`/chat/${user.id}`" class="nav-link">Message</router-link>
                    </button>
                </div>
            </div>
            <div v-else>
                <p class="card-title">No contacts</p>
            </div>
        </div>
        <div class="card-body">
            <h3 class="card-subtitle">All Contacts</h3>
            <div v-if="users">
                <div v-for="user in users" :key="user.id">
                    <div class="card-content">
                        <p class="card-title">{{ user.name }}</p>
                        <p class="card-title">{{ user.email }}</p>
                    </div>
                    <button class="btn btn-primary mr-2" @click="addContact(user.id)">Add</button>
                    <button class="btn btn-primary">
                        <router-link :to="`/chat/${user.id}`" class="nav-link">Message</router-link>
                    </button>
                </div>
            </div>
            <div v-else><p class="card-title">No users</p></div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        users: {
            type: Array,
            required: true
        },
        user: {
            type: Object,
            required: true
        }
    },
    methods: {
        async addContact(id) {
            await this.$store.dispatch('user/addContact', id);
            this.$router.go();
        },
        removeContact(id){
            this.$store.dispatch('user/removeContact', id);
            this.$router.go();
        }
    },
}
</script>