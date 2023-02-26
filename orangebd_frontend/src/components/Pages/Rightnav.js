
import React from 'react';
import { Link } from 'react-router-dom';

const Rightnav = () => {
  let userRole = 0;
  
  if(JSON.parse(localStorage.getItem("USER")))
  {
    let user = JSON.parse(localStorage.getItem("USER"));
    userRole = user.role
  }
  return (
    <div>
      <div className="flex">
            <div className="flex flex-col h-screen p-3 bg-white shadow w-60">
                <div className="space-y-3">
                    <div className="flex items-center">
                      {
                        userRole==0?<><h2 className="text-xl font-bold">Admin Panel</h2></>:
                        userRole==1?<><h2 className="text-xl font-bold">User Portal</h2></>:
                        <><h2 className="text-xl font-bold">Author Portal</h2></>
                      }
                        
                    </div>
                    <div className="flex-1">
                        <ul className="pt-2 pb-4 space-y-1 text-sm">
                        {
                        userRole==0?
                        <>
                        <li className="rounded-sm">
                            <Link className="flex items-center p-2 space-x-3 rounded-md" to='/users'> Users</Link>
                            </li>
                            <li className="rounded-sm">
                                <Link className="flex items-center p-2 space-x-3 rounded-md" to='/categories'>  Categories</Link>
                            </li>
                            <li className="rounded-sm">
                                <Link className="flex items-center p-2 space-x-3 rounded-md" to='/posts'>  Posts</Link>
                                    
                                
                            </li>
                        </>:
                        userRole==1?
                        <>
                        <li className="rounded-sm">
                                <Link className="flex items-center p-2 space-x-3 rounded-md" to='/posts'>  Posts</Link>
                        </li>
                        </>:
                        <>
                         <li className="rounded-sm">
                                <Link className="flex items-center p-2 space-x-3 rounded-md" to='/posts'>  Posts</Link>
                        </li>
                        </>
                      }
                            
                            
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
  );
};

export default Rightnav;