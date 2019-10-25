<template>
    <div>
        <v-chip v-if="loading" class="my-1">
            Загрузка...
        </v-chip>
        <v-chip v-else dark :color="statusElementClass" class="my-1">
            {{ status }}
        </v-chip>
    </div>
</template>

<script>
    import {
        VChip,
    } from 'vuetify/lib'

    export default {
        name: "CmsAppStatus",
        components: {
            VChip
        },
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
                    return 'green'
                } else if (this.statusType === 'warning') {
                    return 'orange'
                } else {
                    return 'red'
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
