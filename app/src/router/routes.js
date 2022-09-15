const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/Index.vue") }],
  },
  {
    path: "/cursos",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/Index1.vue") }],
  },
  {
    path: "/eventos",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/Index2.vue") }],
  },
  {
    path: "/vagas",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/Index3.vue") }],
  },
  {
    path: "/home",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/Index.vue") }],
  },
  {
    path: "/acoes",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/Acoes.vue"),props: true }],
  },
  {
    path: "/lives",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/Lives.vue") }],
  },
  {
    path: "/divulga",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/Divulga.vue") }],
  },
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/Error404.vue"),
  },
  {
    name: "Comunica",
    path: "/comunica",
    beforeEnter() {
      window.open(
        "https://mailchi.mp/pr5/assine-a-comunica-extensao",
        "_blank"
      );
    },
  },
  {
    name: "Projeto",
    path: "/projeto/:id",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      { path: "", component: () => import("pages/Projeto.vue"), props: true },
    ],
  },
  {
    name: "Evento",
    path: "/evento/:id",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      { path: "", component: () => import("pages/Evento.vue"), props: true },
    ],
  },
  {
    name: "Curso",
    path: "/curso/:index",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      { path: "", component: () => import("pages/Curso.vue"), props: true },
    ],
  },
];

export default routes;
