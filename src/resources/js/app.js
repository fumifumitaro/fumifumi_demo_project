import Vue from 'vue'
import { InertiaApp } from '@inertiajs/inertia-vue'

const app = document.getElementById('app')
const page = JSON.parse(app.dataset.page)

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: page,
                resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
            },
        }),
}).$mount(app)