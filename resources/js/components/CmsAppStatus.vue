<template>
    <div>
        <div v-if="loading">
            <span style="font-size: 1rem;" class="badge badge-secondary">Загрузка...</span></div>
        <div v-else>
            <span style="font-size: 1rem;" :class="statusElementClass">{{ status }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CmsAppStatus",
        data() {
            return {
                loading: true,
                status: null,
                apiPath: '/api/status'
            }
        },
        props: {
            url: {
                required: true,
                type: String
            }
        },
        computed: {
            statusElementClass () {
                if (this.status === 'active') {
                    return 'badge badge-success'
                } else {
                    return 'badge badge-danger'
                }
            }
        },
        mounted() {
            let url = this.url.replace(/\/$/, "");
            axios.get(url + this.apiPath)
                .then(response => {
                    if (response.data.status) {
                        this.status = response.data.status
                    } else {
                        this.status = 'no data'
                    }
                })
                .catch(error => {
                    this.status = 'connection error'
                })
                .finally(() => {
                    this.loading = false;
                })
        },
    }
</script>

<style scoped>

</style>
