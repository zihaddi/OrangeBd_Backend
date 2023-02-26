
import './App.css';
import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import Home from './components/Pages/Home';
import Login from './components/shared/Login';
import Register from './components/shared/Register';
import Main from './components/layouts/Main';

import Dashboard from './components/Pages/Dashboard';
import Posts from './components/Posts';
import Categories from './components/Categories';
import Users from './components/Users';


function App() {
  const router = createBrowserRouter([
   {
    path:'/',
    element:<Main></Main>,
    children:[
      {
        path:'/',
        element:<Home></Home>
      },
      {
        path:'/login',
        element:<Login></Login>
      },
      {
        path:'/register',
        element:<Register></Register>
      },
      {
        path:'/users',
        element:<Users></Users>
      },
      {
        path:'/posts',
        element:<Posts></Posts>
      },
      {
        path:'/categories',
        element:<Categories></Categories>
      },
      {
        path:'/dashboard',
        element:<Dashboard></Dashboard>
      },
    ]
   }
  ]);
  return (
    <div className="container m-auto">
      <RouterProvider router={router}></RouterProvider>
    </div>
  );
}

export default App;
