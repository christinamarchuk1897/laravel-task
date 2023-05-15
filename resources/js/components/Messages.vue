<template >
    <div class="card-body">
        <h3 class="card-subtitle">My Chats</h3>
        <template v-if="Object.keys(latest).length">
            <div class="card-content-msg" v-for="records in latest">
                <router-link class="chat-box-msg" :to="`/chat/${records[records.length - 1].user.id}`">
                    <div>
                        <p class="card-title bold">{{ records[records.length - 1].user.name }}</p>
                        <p class="card-title">{{ records[records.length - 1].message }}</p>
                    </div>
                    <span class="chat-msg-count">
                        {{ records.length }}
                    </span>
                </router-link>
            </div>
        </template>
        <template v-else>
            No recent activities
        </template>
    </div>
</template>
<script>
export default {
    props: ['latest']
}
</script>
<style lang="scss">
.card-content-msg {
    border: 1px solid grey;
    border-radius: 8px;
    transition: .3s linear;
    padding: 10px;
    &:hover {
        background-color: azure;
        cursor: pointer;
    }
}
.chat-box-msg {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #000;
    text-decoration: none;
    &:hover{
        color: #000;
    }
}
.chat-msg-count {
    display: inline-flex;
    width: 30px;
    height: 30px;
    justify-content: center;
    align-items: column;
    border-radius: 50%;
    background-color: green;
    color: aliceblue;
    padding: 4px;
}
</style>