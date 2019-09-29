<template>
    <div class="row">
        <div v-if="loading">Загрузка...</div>

        <cms-app-plugin-card v-for="(plugin, index) in plugins" :key="'plugin_card_' + index"
                             :scheme="plugin.scheme"
                             :invalid="plugin.invalid"
                             :app-key="appKey"
                             :cms-app-url="cmsAppUrl"
                             @change="retry"
        ></cms-app-plugin-card>

        <div v-if="errorStatus">
        <span>
            Ошибка при загрузке данных о плагинах.
        </span>
            <button @click="retry" class="btn btn-info" type="button">Повторить попытку</button>
        </div>
    </div>
</template>

<script>
    import CmsAppPluginCard from './CmsAppPluginCard'

    export default {
        name: "CmsAppPluginList",
        components: {
            CmsAppPluginCard
        },
        data () {
            return {
                loading: true,
                plugins: [],
                apiPath: '/api/plugins/list',
                errorStatus: false
            }
        },
        props: {
            cmsAppUrl: {
                required: true,
                type: String
            },
            appKey: {
                required: true,
                type: String
            },
        },
        mounted () {
            this.loadData();
        },
        methods: {
            retry () {
                this.loading = true;
                this.plugins = [];
                this.errorStatus = false;
                this.loadData();
            },
            loadData () {
                let url = this.cmsAppUrl.replace(/\/$/, "");
                axios.get(url + this.apiPath, {
                    params: {
                        key: this.appKey
                    },
                })
                    .then(response => {
                        if (response.data) {
                            this.plugins = response.data
                        }
                    })
                    .catch(error => {
                        this.errorStatus = true
                    })
                    .finally(() => {
                        this.loading = false;
                    })
            },
        }
    }
</script>

<style scoped>

</style>
