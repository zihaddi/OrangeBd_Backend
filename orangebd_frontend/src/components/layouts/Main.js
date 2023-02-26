import React from 'react';
import { Outlet } from 'react-router-dom';
import Rightnav from '../Pages/Rightnav';
import Footer from '../shared/Footer';
import Header from '../shared/Header';

const Main = () => {
  let user = JSON.parse(localStorage.getItem("USER"));
  return (
    <div>
      <Header></Header>
      <div class="flex">
        {
           user? 
           <>
           <div class="w-1/4 ">
           <Rightnav></Rightnav>
           </div>
           <div class="w-3/4 ">
           <Outlet></Outlet>
           </div>
           </>:
           <>
            <div className='w-full'>
             <Outlet></Outlet>
            </div>
           </>
        }
        
       
       
      </div>
      <Footer></Footer>
    </div>
  );
};

export default Main;