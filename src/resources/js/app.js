import Vue from 'vue'
import { InertiaApp } from '@inertiajs/inertia-vue'

const app = document.getElementById('app')
const page = JSON.parse(app.dataset.page)
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI)

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: page,
                resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
            },
        }),
}).$mount(app)