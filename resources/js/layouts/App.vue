<template>
    <v-app id="inspire">
        <!-- Left sidebar -->
        <v-navigation-drawer
                v-model="drawer"
                app
                clipped
        >
            <slot name="sidebar">
                <v-list dense>
                    <v-list-item @click="">
                        <v-list-item-action>
                            <v-icon>mdi-home</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Home</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </slot>
        </v-navigation-drawer>

        <!-- Top navbar -->
        <v-app-bar
                app
                color="indigo"
                dark
                clipped-left
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>{{ appName }}</v-toolbar-title>

            <v-spacer></v-spacer>

            <!--<v-btn icon>-->
                <!--<v-icon>mdi-account-circle</v-icon>-->
            <!--</v-btn>-->

            <slot name="app_top_right_menu" :logoutSubmit="logoutSubmit">
                <v-menu
                        left
                        bottom
                >
                    <template v-slot:activator="{ on }">
                        <v-btn icon v-on="on">
                            <v-icon>mdi-account-circle</v-icon>
                        </v-btn>
                    </template>

                    <v-list>
                        <v-list-item @click="() => {}"
                        >
                            <v-list-item-title>Option 1</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </slot>
        </v-app-bar>

        <!-- Content -->
        <v-content>
            <slot name="content">Content...</slot>
        </v-content>

        <!-- Footer -->
        <v-footer
                color="indigo"
                app
        >
            <span class="white--text">PressStart Developers &copy; 2019</span>
        </v-footer>
    </v-app>
</template>

<script>
    import {
        VApp,
        VNavigationDrawer,
        VList,
        VListItem,
        VListItemAction,
        VListItemContent,
        VListItemTitle,
        VIcon,
        VAppBar,
        VAppBarNavIcon,
        VToolbarTitle,
        VContent,
        VContainer,
        VRow,
        VCol,
        VTooltip,
        VBtn,
        VFooter,
        VSpacer,
        VMenu,
    } from 'vuetify/lib'

    export default {
        name: 'App',
        components: {
            VApp,
            VNavigationDrawer,
            VList,
            VListItem,
            VListItemAction,
            VListItemContent,
            VListItemTitle,
            VIcon,
            VAppBar,
            VAppBarNavIcon,
            VToolbarTitle,
            VContent,
            VContainer,
            VRow,
            VCol,
            VTooltip,
            VBtn,
            VFooter,
            VSpacer,
            VMenu,
        },
        props: {
            source: String,
            appName: {
                required: false,
                type: String,
                default () {
                    return 'Application'
                }
            },
        },
        data: () => ({
            drawer: null,
        }),
        methods: {
            logoutSubmit () {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            }
        }
    }
</script>
