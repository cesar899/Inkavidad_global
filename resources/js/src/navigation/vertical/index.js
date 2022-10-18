/*

Array of object

Top level object can be:
1. Header
2. Group (Group can have navItems as children)
3. navItem

* Supported Options

/--- Header ---/

header

/--- nav Grp ---/

title
icon (if it's on top level)
tag
tagVariant
children

/--- nav Item ---/

icon (if it's on top level)
title
route: [route_obj/route_name] (I have to resolve name somehow from the route obj)
tag
tagVariant

*/
import dashboard from './dashboard'
import appsAndPages from './apps-and-pages'
import others from './others'
import chartsAndMaps from './charts-and-maps'
import uiElements from './ui-elements'
import formAndTable from './forms-and-table'
import batches from './batches'
import projects from './projects'
import groups from './groups'
import users from './users'
import orders from './orders'
import sellers from './sellers'
import sellerBatch from './sellerBatch'
import clients from './clients'
import sales from './sales'

// Array of sections
export default [...clients, ...sellerBatch, ...sellers, ...orders, ...users, ...dashboard, ...appsAndPages, ...uiElements, ...formAndTable, ...chartsAndMaps, ...others, ...batches, ...projects, ...groups, ...sales]
