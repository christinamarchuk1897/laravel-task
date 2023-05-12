<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Forgot Password</h1>
                        <hr/>
                        <form action="javascript:void(0)" class="row" method="post">
                            <div class="form-group col-12">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="email" v-model="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="col-12 mb-2">
                                <button type="submit" @click="sentEmail" class="btn btn-primary btn-block">
                                    Sent
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email:""
            }
        },
        methods: {
            async sentEmail() {
                await this.$store.dispatch('auth/sentEmail', this.email);
            }
        }
    }
</script>