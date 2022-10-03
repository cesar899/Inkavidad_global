import Vue from 'vue'
import VueRouter from 'vue-router'
import batchRoutes from './batchs/routes'
import projectsRoutes from './projects/routes'
import groupsRoutes from './groups/routes'

// Routes
import { canNavigate } from '@/libs/acl/routeProtection'
import { isUserLoggedIn, getUserData, getHomeRouteForLoggedInUser } from '@/auth/utils'
import apps from './routes/apps'
import dashboard from './routes/dashboard'
import uiElements from './routes/ui-elements/index'
import pages from './routes/pages'
import chartsMaps from './routes/charts-maps'
import formsTable from './routes/forms-tables'
import others from './routes/others'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    { path: '/', redirect: { name: 'dashboard-ecommerce' } },
    ...apps,
    ...batchRoutes,
		...projectsRoutes,
		...groupsRoutes,
    ...dashboard,
    ...pages,
    ...chartsMaps,
    ...formsTable,
    ...uiElements,
    ...others,
    {
      path: '*',
      redirect: 'error-404',
    },
  ],
})

router.beforeEach((to, from, next) => {
  const token = sessionStorage.getItem('jwt')

  if(!token){
    if(to.path !== '/login'){
      return next('/login')
    }
  }

  return next()
})

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
	// Remove initial loading
	const appLoading = document.getElementById('loading-bg')
	if (appLoading) {
		appLoading.style.display = 'none'
	}
})

export default router
