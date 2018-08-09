import Dashboard from '../components/admin/Dashboard'
import NewAdmin from '../components/admin/NewAdmin'
import Categories from '../components/admin/Categories'
import CreateItem from '../components/items/ItemCreate'
import ItemsList from '../components/items/ListItems'
import ToppingPage from '../components/toppings/ToppingPage'
import ShowCart from '../components/public/cart/ShowCart'

//import MenuItems from '../components/public/MenuItems'


export const routes =[
    {path: '/dashboard', name:'dashboard', component: Dashboard},
    {path: '/new-admin', name: 'new-admin', component:NewAdmin},
    {path: '/categories', name: 'categories', component:Categories},
    {path: '/create_item', name: 'create_item', component:CreateItem},
    {path:'/list_items', name: 'list_items', component:ItemsList},
    {path:'/topping_page', name: 'topping_page', component:ToppingPage},

    {path:'/cart', name:'show_cart', component:ShowCart},

    //{path: '/menu_items', name: 'menu_items', component:{public_side:MenuItems}}
];
