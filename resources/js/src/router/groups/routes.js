export default [
    {
        path: '/groups/create',
        name: 'groups-create',
        component: () => import('@/views/groups/create'),
        meta: {
            pageTitle: 'Crear Grupo',
            breadcrumb: [
                {
                    text: 'crear grupo',
                    active: true,
                },
            ],
        },
    },
]