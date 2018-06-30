import Dashboard from '../components/admin/Dashboard'
import NewAdmin from '../components/admin/NewAdmin'
import Categories from '../components/admin/Categories'
import CreateItem from '../components/items/ItemCreate'
import ItemsList from '../components/items/ListItems'


export const routes =[
    {path: '/dashboard', name:'dashboard', component: Dashboard},
    {path: '/new-admin', name: 'new-admin', component:NewAdmin},
    {path: '/categories', name: 'categories', component:Categories},
    {path: '/create_item', name: 'create_item', component:CreateItem},
    {path:'/list_items', name: 'list_items', component:ItemsList},
];