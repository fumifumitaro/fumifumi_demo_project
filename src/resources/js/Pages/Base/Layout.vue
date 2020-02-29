<template>
    <div>
        <header>
            <div class="items-right flex">
                <div class="header-links items-under" style="padding: 1em">
                    <a :href="$route('login')"
                       v-show="!auth"
                    >
                        Login
                    </a>
                    <a :href="$route('register')"
                       v-if="!auth"
                    >
                        Register
                    </a>
                    <a v-show="auth">
                        ようこそ{{ $page.auth.user.name }}さん
                    </a>
                    <a :href="$route('logout')"
                       v-show="auth"
                    >
                        Logout
                    </a>
                </div>
            </div>
        </header>
        <slot/>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                auth: false,
            }
        },
        created() {
            if (this.$page.auth.user.id) {
                this.auth = true
            }
        }
    }
</script>