export default [
  {
    
    title: 'Proyectos',
    icon: 'PackageIcon',
    children: [
      {
        title: 'Listado de proyectos',
        route: 'projects',
        icon: 'FileIcon',
        resource: 'adminBatch',
        action: 'read',
      },
      {
        title: 'Creacion de grupos',
        route: 'groups-create',
        icon: 'FileIcon',
        resource: 'adminBatch',
        action: 'read'
      },
      {
        title: 'Lotes',
        route: 'batchs',
        icon: 'FileIcon',
        resource: 'adminBatch',
        action: 'read'
      },
    ],
  },
]
