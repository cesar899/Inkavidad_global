export default [
    {
        path: '/projects',
        name: 'projects',
        component: () => import('@/views/projects'),
        meta: {
            pageTitle: 'Projects',
            breadcrumb: [
                {
                    text: 'Project',
                    active: true,
                },
              ],
        },
    },
    {
        path: '/projects/create',
        name: 'projects-create',
        component: () => import('@/views/projects/create'),
        meta: {
            pageTitle: 'Create Project',
            breadcrumb: [
                {
                    text: 'create Project',
                    active: true,
                },
              ],
        },
    },
    {
        path: '/projects/available',
        name: 'projects-available',
        component: () => import('@/views/projects/seller'),
        meta: {
            pageTitle: 'Available Projects',
            breadcrumb: [
                {
                    text: 'available projects',
                    active: true,
                },
              ],
        },
    },
    {
        path: '/projects/:project_id',
        name: 'project-show',
        component: () => import('@/views/projects/show.vue'),
        meta: {
            pageTitle: 'Administrar Proyecto',
            breadcrumb: [
                {
                    text: 'administrar Proyecto',
                    active: true,
                },
              ],
        },
    },
    {
        path: '/projects/:project_id/groups/sell',
        name: 'project-groups-seller',
        component: () => import('@/views/projects/seller/show.vue'),
        meta: {
            pageTitle: 'Grupos del proyecto',
            breadcrumb: [
                {
                    text: 'grupos del proyecto',
                    active: true,
                },
              ],
        },
    },
    {
        path: '/projects/:project_id/groups',
        name: 'project-groups',
        meta: {
            pageTitle: 'Grupos del proyecto',
            breadcrumb: [
                {
                    text: 'grupos del proyecto',
                    active: true,
                },
              ],
        },
    },
]