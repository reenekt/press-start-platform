<template>
    <v-app id="inspire">
        <v-content>
            <v-container
                    class="fill-height"
                    fluid
            >
                <v-row
                        align="center"
                        justify="center"
                >
                    <v-col
                            cols="12"
                            sm="8"
                            md="4"
                    >
                        <slot>

                        </slot>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    import {
        VApp,
        VContent,
        VContainer,
        VRow,
        VCol,
    } from 'vuetify/lib'

    export default {
        name: "AppCenteredContent",
        components: {
            VApp,
            VContent,
            VContainer,
            VRow,
            VCol,
        },
        props: {
            source: String,
            appName: {
                required: false,
                type: String,
                default () {
                    return 'Application'
                }
            }
        },
        data: () => ({
            drawer: null,
        }),
    }
</script>
