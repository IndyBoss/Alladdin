import Vue from 'vue'
import VueRouter from  'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'

import Home from '../views/Home.vue'
import MassMessage from '../views/MassMessage.vue'
import TaskProcessor from '../views/TaskProcessor.vue'
import Error from '../views/Error.vue'
import Schedule from '../views/Schedule.vue'

Vue.use(VueRouter, VueAxios, axios);

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
    meta: {title: 'SoialMole - Home'}
  },
  {
    path: '/post',
    name: 'post',
    component: MassMessage,
    meta: {title: 'SocialMole - Message'}
  },
  {
    path: '/ida',
    name: 'ida',
    component: MassMessage,
    meta: {title: 'SocialMole - Message'}
  },
  {
    path: '/2pointo',
    name: '2pointo',
    component: MassMessage,
    meta: {title: 'SocialMole - Message'}
  },
  {
    path: '/fectiv',
    name: 'fectiv',
    component: MassMessage,
    meta: {title: 'SocialMole - Message'}
  },
  {
    path: '/taskprocessor',
    name: 'taskprocessor',
    component: TaskProcessor,
    meta: {title: 'SocialMole - Processing'}
  },
  {
    path: '/schedule',
    name: 'schedule',
    component: Schedule,
    meta: {title: 'SocialMole - Schedule'}
  },
  {
    path: '*',
    component: Error,
    meta: {title: 'SocialMole - Tunnel not found'}
  }
]

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router
