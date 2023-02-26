import React, { useEffect, useState } from 'react';
import axios from 'axios'
const Users = () => {

  let [products, setProducts] = useState([]);
  useEffect(() => {
    axios
      .get("http://127.0.0.1:8000/api/users" ,
      {
        headers: {
          'Authorization': `Bearer ${JSON.parse(localStorage.getItem('TOKEN'))}`
        }
      })
      .then((response) => {
         console.log(response.data)
        setProducts(response.data);
      })
      .catch((error) => console.error(error));
  }, []);


  return (
    <div className="overflow-x-auto w-full">
  <table className="table  mt-3 mr-4">
    
    <thead>
      <tr>
         
        
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    {
        products.map(product => 
          <>
          <tr>
        
        
        <td>{product.name}</td>
        <td>{product.email}</td>
        <td>
        {product.role === 0?
                 <><p className="badge badge-secondary">Admin</p></>:
                 product.role === 1?
                 <><p className="badge badge-primary"> User </p></> :
                 product.role === 2?
                 <><p className="badge badge-success"> Author </p></> :
                 <></>
                 }
        </td>
      </tr>
          </>)
      }
    </tbody>
    
    
  </table>
</div>
  );
};

export default Users;