import React, { useEffect, useState } from "react";
import axios from "axios";
const Categories = () => {
  let [products, setProducts] = useState([]);
  let [currentCategory, setCurrentcategory] = useState([]);
  useEffect(() => {
    axios
      .get("http://127.0.0.1:8000/api/categories", {
        headers: {
          Authorization: `Bearer ${JSON.parse(localStorage.getItem("TOKEN"))}`,
        },
      })

      .then((response) => {
        setProducts(response.data);
      })
      .catch((error) => console.error(error));
  }, []);

  const handleAdd = (event) => {
    event.preventDefault();
    let name = event.target.namee.value;
    let data = { name: name };
    fetch("http://127.0.0.1:8000/api/categoriesAdd", {
      method: "POST", // or 'PUT'
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Success:", data);
        setProducts(data);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  const preEdit = (id) => {
    let data = { id: id };
    fetch("http://127.0.0.1:8000/api/categoryEdit", {
      method: "POST", // or 'PUT'
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Success:", data);
        setCurrentcategory(data);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  const handleEdit = (event) => {
    event.preventDefault();
    let name = event.target.namee.value;
    let data = { name: name, id: currentCategory.id };
    fetch("http://127.0.0.1:8000/api/categoriesEdit", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        setProducts(data);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  return (
    //Modal1
    <div className="flex flex-col justify-center">
      <input type="checkbox" id="my-modal" className="modal-toggle" />
      <div className="modal">
        <div className="modal-box">
          <form onSubmit={handleAdd} action="">
            <h4>Name : </h4>
            <input
              type="text"
              name="namee"
              placeholder="Input Name"
              className="input input-bordered w-full max-w-xs"
            />
            <div className="modal-action flex justify-around">
              <button className="btn btn-outline btn-info btn-sm" type="submit">
                <label htmlFor="my-modal">Add Category</label>{" "}
              </button>
              <label
                htmlFor="my-modal"
                className="btn btn-outline btn-warning btn-sm"
              >
                Back
              </label>
            </div>
          </form>
        </div>
      </div>
      {/* Modal */}
      {/* Modal2 */}
      <input type="checkbox" id="my-modal2" className="modal-toggle" />
      <div className="modal">
        <div className="modal-box">
          <form onSubmit={handleEdit} action="">
            <h4>Name : </h4>
            <input
              type="text"
              name="namee"
              placeholder="Type here"
              className="input input-bordered w-full max-w-xs"
              defaultValue={currentCategory.name}
            />
            <div className="modal-action flex justify-around">
              <button className="btn btn-outline btn-info btn-sm" type="submit">
                <label htmlFor="my-modal2">Edit</label>{" "}
              </button>
              <label
                htmlFor="my-modal2"
                className="btn btn-outline btn-warning btn-sm"
              >
                Back
              </label>
            </div>
          </form>
        </div>
      </div>
      {/* Modal2  */}
      <div className="mt-4 mb-3">
        <button className="btn btn-outline btn-warning btn-sm">
          <label htmlFor="my-modal">Add Category</label>
        </button>
      </div>
      <div className="overflow-x-auto  w-full ">
        <table className="table  mt-3  ">
          <thead>
            <tr>
              <th>Name</th>
              <th>Operation</th>
            </tr>
          </thead>
          <tbody>
            {products.map((product) => (
              <>
                <tr>
                  <td>{product.name}</td>
                  <td>
                    <button
                      onClick={() => preEdit(product.id)}
                      className="btn btn-info btn-xs mr-2"
                    >
                      <label htmlFor="my-modal2">Edit</label>
                    </button>
                    <button className="btn btn-error btn-xs">Delete</button>
                  </td>
                </tr>
              </>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default Categories;
