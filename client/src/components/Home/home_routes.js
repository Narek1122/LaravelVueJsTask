
import HomePage from "./HomePage";
import HomeDetails from "./HomeDetails";
import About from "./About";
import HomeSearch from "./HomeSearch";

export default [
  {
    path: '/home',
    name: 'HomePage',
    component: HomePage
  },
  {
    path: '/home/:part_id/details',
    name: 'HomeDetails',
    component: HomeDetails
  },
  {
    path: '/home/about',
    name: 'About',
    component: About
  },
  {
    path: '/home/search',
    name: 'HomeSearch',
    component: HomeSearch
  },


]
