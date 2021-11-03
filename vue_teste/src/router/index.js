import Vue from 'vue'
import VueRouter from 'vue-router'

import Index from '@/views/Index.vue'
import NotFound from '@/views/NotFound.vue'
import Mock from '@/views/Mock.vue';
import TipoDocumento from '@/views/TipoDocumento.vue';

Vue.use(VueRouter)

const routes = [
  {
    path: '*',
    name: 'NotFound',
    component: NotFound
  }, {
    path: '/',
    name: 'Index',
    component: Index
  },{
    path: '/Mock',
    name: 'Mock',
    component: Mock
  },{
    path: '/TipoDocumento',
    name: 'TipoDocumento',
    component: TipoDocumento
  }

]

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router
