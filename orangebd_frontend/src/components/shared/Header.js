import axios from 'axios';
import React from 'react';
import { Link, useNavigate } from 'react-router-dom';

const Header = () => {
  const navigate = useNavigate();

  const loadLogout = () => {
    axios
      .post(
        "http://127.0.0.1:8000/api/auth/logout",
        {},
        {
          headers: {
            Authorization: `Bearer ${JSON.parse(
              localStorage.getItem("TOKEN")
            )}`,
          },
        }
      )
      .then((res) => {
       // console.log(res.data);
        localStorage.removeItem("TOKEN");
        localStorage.removeItem('USER')
        localStorage.removeItem('CART')
         
        navigate("/login");
        window.location.reload();
      })
      .catch((error) => {
        console.error(error);
      });
  };

 

  const user = JSON.parse(localStorage.getItem("USER"));
  return (
    <div className='mt-4'>
      {/* modal portion */}
      <input type="checkbox" id="my-modal-5" className="modal-toggle" />
      <div className="modal">
        <div className="modal-box w-11/12 max-w-5xl">
          <h3 className="font-bold text-lg">Welcome , {user? user.name : ''}</h3>
          <p className="py-4">Your Mail : {user ? user.email : ''}</p>
          <div className="modal-action">
            <label htmlFor="my-modal-5" className="btn">
              Ok!
            </label>
          </div>
        </div>
      </div>
      {/* modal portion */}
      <div class="navbar bg-primary text-primary-content">
  <div class="flex-1">
    <Link to='/dashboard'>Blog Post</Link>
  </div>
  <div class="flex-none gap-2">
   
    <ul className="menu menu-horizontal px-1">
            {localStorage.getItem("TOKEN") ? (
              <>
                {/* <div className="d-flex">
                <Link to="/posts">Posts</Link>
                </div> */}
              </>
            ) : (
              <>
                  <Link to="/login">Login</Link>
              </>
            )}
            
          </ul>
         {localStorage.getItem("TOKEN")?
         (
             <>
              <div class="dropdown dropdown-end">
              <label tabindex="0" class="btn btn-ghost  avatar">
              
              {user? user.name : ''}
             
              </label>
              <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
              <li>
              <label htmlFor="my-modal-5" className="justify-between">
                        Profile
                      </label>
             </li>
             <button onClick={loadLogout}>Logout</button>
             </ul>
             </div>
             </>
             ):
             (
            <></>
             )}
  </div>
</div>
    </div>
  );
};

export default Header;