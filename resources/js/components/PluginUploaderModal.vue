<template>
    <v-dialog
            v-model="dialog"
            fullscreen
    >
        <template v-slot:activator="{ on }">
            <v-btn
                    color="green"
                    dark
                    absolute
                    bottom
                    right
                    fab
                    x-large
                    class="mb-12 mr-4"
                    v-on="on"
            >
                <v-icon>mdi-plus</v-icon>
            </v-btn>
        </template>

        <v-card>
            <v-toolbar
                    color="primary"
                    dark
                    class="mb-10"
            >
                <v-spacer></v-spacer>
                <v-toolbar-title>Загрузка плагина</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn icon dark @click="dialog = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>

            <v-card-text>
                <plugin-zip-uploader :submit-url="storeUrl"></plugin-zip-uploader>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                        color="primary"
                        @click="dialog = false"
                >
                    Закрыть
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import {
        VDialog,
        VBtn,
        VIcon,
        VCard,
        VToolbar,
        VSpacer,
        VToolbarTitle,
        VCardText,
        VDivider,
        VCardActions,
        VToolbarItems,
    } from 'vuetify/lib'

    export default {
        name: "PluginUploaderModal",
        components: {
            VDialog,
            VBtn,
            VIcon,
            VCard,
            VToolbar,
            VSpacer,
            VToolbarTitle,
            VCardText,
            VDivider,
            VCardActions,
            VToolbarItems,
        },
        data() {
            return {
                dialog: false,
            }
        },
        props: {
            storeUrl: {
                required: true,
                ttype: String,
            }
        },
    }
</script>

<style scoped>

</style>
