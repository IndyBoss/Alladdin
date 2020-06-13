import Vue from 'vue';
import App from './App.vue';
import router from './router/router.js';
import BootstrapVue from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import  './assets/css/main.css';
import Vuelidate from 'vuelidate'
import vuetify from './plugins/vuetify';

Vue.use(Vuelidate);
Vue.use(BootstrapVue);

Vue.config.productionTip = false;

new Vue({
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')
