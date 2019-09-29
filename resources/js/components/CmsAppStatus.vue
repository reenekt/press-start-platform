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
                statusType: 'error',
                apiPath: '/api/status'
            }
        },
        props: {
            url: {
                required: true,
                type: String
            },
            appKey: {
                required: true,
                type: String
            },
        },
        computed: {
            statusElementClass () {
                if (this.statusType === 'active') {
                    return 'badge badge-success'
                } else if (this.statusType === 'warning') {
                    return 'badge badge-warning'
                } else {
                    return 'badge badge-danger'
                }
            }
        },
        mounted() {
            let url = this.url.replace(/\/$/, "");
            axios.get(url + this.apiPath, {
                params: {
                    key: this.appKey
                },
            })
                .then(response => {
                    if (response.data.status) {
                        this.status = 'Работает';
                        this.statusType = response.data.status
                    } else {
                        this.status = 'no data'
                    }
                })
                .catch(error => {
                    if (error.response && error.response.data) {
                        if (error.response.data.message === "Wrong CMS key") {
                            this.status = 'Неверный ключ приложения'
                            this.statusType = 'warning'
                        } else {
                            this.status = 'Ошибка соединения'
                            this.statusType = 'error'
                        }
                    } else {
                        this.status = 'Ошибка соединения'
                        this.statusType = 'error'
                    }
                })
                .finally(() => {
                    this.loading = false;
                })
        },
    }
</script>

<style scoped>

</style>
