<template >
    <div class="card card-body">
        <h3 class="card-title">Personal Stats</h3>
        <div v-if="user">
            <span class="card-title bold">{{ user.name }}</span>
            <br>
            <span class="card-title bold">{{ user.email }}</span>
            <br>
            <h5 class="card-subtitle">Contacts</h5>
            <span v-if="user.contacts">{{ user.contacts.length }}</span>
            <span v-else class="card-title">0</span>
            <h5 class="card-subtitle">Messages</h5>
            <span>0</span>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        user:{
            type: Object,
            reqired: true
        }
    }
}
</script>
<style lang="scss">
    .bold {
        font-weight: 600;
    }
</style>