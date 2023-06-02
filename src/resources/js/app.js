import "./bootstrap";

import Vue from "vue";
import { InertiaApp } from "@inertiajs/inertia-vue";
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import mavonEditor from "mavon-editor";
import "mavon-editor/dist/css/index.css";
import axios from "axios";

Vue.use(InertiaApp);
Vue.use(ElementUI);
Vue.use(mavonEditor);

Vue.prototype.$route = (...args) => route(...args).url();
Vue.config.devtools = true;
new Vue({
  render: (h) =>
    h(InertiaApp, {
      props: {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: (name) =>
          import(`@/Pages/${name}`).then((module) => module.default),
      },
    }),
}).$mount(document.getElementById("app"));
