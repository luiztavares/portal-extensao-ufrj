import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '',
        name: 'home',
        component: () => import('pages/IndexPage.vue'),
      },
    ],
  },
  {
    name: '',
    path: '/pesquisa',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        name: 'pesquisa',
        path: '',
        component: () => import('pages/SearchPage.vue'),
        props: true,
      },
      {
        name: 'cursos',
        path: '/cursos',
        component: () => import('pages/SearchPage.vue'),
        props: true,
      },
      {
        name: 'eventos',
        path: '/eventos',
        component: () => import('pages/SearchPage.vue'),
        props: true,
      },
      {
        name: 'atividades',
        path: '/atividades',
        component: () => import('pages/SearchPage.vue'),
        props: true,
      },
      {
        name: 'vagas',
        path: '/vagas',
        component: () => import('pages/SearchPage.vue'),
        props: true,
      },
    ],
  },
  {
    path: '/divulga',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '',
        name: 'divulga',
        component: () => import('pages/DivulgaPage.vue'),
      },
    ],
  },
  {
    path: '/acoes',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '',
        name: 'acoes',
        component: () => import('pages/AcoesPage.vue'),
        props: true,
      },
    ],
  },
  {
    name: 'acao',
    path: '/acao/:id',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        name: 'mural',
        path: '',
        component: () => import('pages/MuralPage.vue'),
        props: true,
      },
      {
        name: 'acaoChildren',
        path: ':timestamp',
        component: () => import('pages/SinglePage.vue'),
        props: true,
      },
    ],
  },

  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
