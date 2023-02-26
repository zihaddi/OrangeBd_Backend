import React, { useEffect, useState } from "react";
import axios from "axios";
import Swal from "sweetalert2";
const Posts = () => {
  let [products, setProducts] = useState([]);
  let [authors, setAuthors] = useState([]);
  let [categories, setCategories] = useState([]);
  let [authored, setAuthored] = useState([]);
  let [category, setCategory] = useState([]);
  let [currentpost, setCurrentpost] = useState([]);
  let userRole = 0;

  if (JSON.parse(localStorage.getItem("USER"))) {
    let user = JSON.parse(localStorage.getItem("USER"));
    userRole = user.role;
  }
  useEffect(() => {
    axios
      .get("http://127.0.0.1:8000/api/posts", {
        headers: {
          Authorization: `Bearer ${JSON.parse(localStorage.getItem("TOKEN"))}`,
        },
      })
      .then((response) => {
        console.log(response.data);
        setProducts(response.data);
      })
      .catch((error) => console.error(error));
  }, []);

  useEffect(() => {
    axios
      .get("http://127.0.0.1:8000/api/postAdd", {
        headers: {
          Authorization: `Bearer ${JSON.parse(localStorage.getItem("TOKEN"))}`,
        },
      })
      .then((response) => {
        setAuthors(response.data.author);
        setCategories(response.data.category);
      })
      .catch((error) => console.error(error));
  }, []);

  const handleAdd = async (event) => {
    event.preventDefault();
    let uid = event.target.uid.value;
    let cid = event.target.cid.value;
    let title = event.target.title.value;
    let description = event.target.description.value;
    let data = { uid, cid, title, description };
    console.log(data);
    await fetch("http://127.0.0.1:8000/api/postsAdd", {
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
        event.target.reset();
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  const handleChangeAuthor = (e) => {
    console.log("Fruit Selected!! :", e.target.value);
    setAuthored({ author: e.target.value });
  };

  const handleChangeCategory = (e) => {
    console.log("Fruit Selected!! :", e.target.value);
    setCategory({ category: e.target.value });
  };

  const preEdit = (id) => {
    let data = { id: id };
    //console.log(data)
    fetch("http://127.0.0.1:8000/api/postEdit", {
      method: "POST", // or 'PUT'
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Success:", data);
        setCurrentpost(data);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  const preDelete = (id) => {
    let data = { id: id };
    //console.log(data)
    fetch("http://127.0.0.1:8000/api/postDelete", {
      method: "POST", // or 'PUT'
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    })
      .then((response) => response.json())
      .then((result) => {
        if (result) {
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
          let a = products.filter((product) => product != result);
          setProducts(a);
        }
      });
  };

  const handleEdit = (event) => {
    event.preventDefault();
    let uid = event.target.uid.value;
    let cid = event.target.cid.value;
    let title = event.target.title.value;
    let description = event.target.description.value;
    let data = {
      uid: uid,
      cid: cid,
      id: currentpost.id,
      title: title,
      description: description,
    };
    //console.log(data)
    fetch("http://127.0.0.1:8000/api/postsEdit", {
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
    <div className="overflow-x-auto w-full">
      <input type="checkbox" id="my-modal" className="modal-toggle" />
      <div className="modal">
        <div className="modal-box">
          <form onSubmit={handleAdd} action="">
            {/* author  */}
            <div className="mt-2">
              <select
                name="uid"
                onChange={handleChangeAuthor}
                className="select select-primary w-full max-w-xs"
              >
                {authors.map((author) => (
                  <option key={author.id} value={author.id}>
                    {author.name}
                  </option>
                ))}
              </select>
            </div>

            {/* Category  */}
            <div className="mt-2">
              <select
                name="cid"
                onChange={handleChangeCategory}
                className="select select-primary w-full max-w-xs"
              >
                {categories.map((category) => (
                  <option key={category.id} value={category.id}>
                    {category.name}
                  </option>
                ))}
              </select>
            </div>

            <input
              type="text"
              name="title"
              placeholder="Title"
              className="input input-bordered w-full max-w-xs mt-2"
            />
            <textarea
              name="description"
              className="w-4/5 mt-4 textarea textarea-primary"
              placeholder="Description"
            ></textarea>

            <div className="modal-action flex justify-around">
              <button className="btn btn-outline btn-info btn-sm" type="submit">
                <label htmlFor="my-modal">Add Post</label>{" "}
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
      <input type="checkbox" id="my-modal2" className="modal-toggle" />
      <div className="modal">
        <div className="modal-box">
          <form onSubmit={handleEdit} action="">
            {/* author  */}
            <div className="mt-2">
              <input
                type="text"
                name="uid"
                placeholder="uid"
                className="input input-bordered w-full max-w-xs mt-2"
                value={currentpost.author_name}
                disabled
              />
            </div>

            {/* Category  */}
            <div className="mt-2">
              <input
                type="text"
                name="cid"
                placeholder="cid"
                className="input input-bordered w-full max-w-xs mt-2"
                value={currentpost.category_name}
                disabled
              />
            </div>

            <input
              type="text"
              name="title"
              placeholder="Title"
              className="input input-bordered w-full max-w-xs mt-2"
              defaultValue={currentpost.title}
            />
            <textarea
              name="description"
              className="w-4/5 mt-4 textarea textarea-primary"
              placeholder="Description"
              defaultValue={currentpost.description}
            ></textarea>

            <div className="modal-action flex justify-around">
              <button className="btn btn-outline btn-info btn-sm" type="submit">
                <label htmlFor="my-modal2">Add Post</label>{" "}
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
      {/* Modal2 */}
      {/* Modal3 */}
      <div className="mt-4 mb-3">
        {userRole != 1 ? (
          <>
            <button className="btn btn-outline btn-warning btn-sm">
              <label htmlFor="my-modal">Add Posts</label>
            </button>
          </>
        ) : (
          <></>
        )}
      </div>
      {/* <table className="table  mt-3 mr-4">
    
    <thead>
      <tr>        
        <th>Author</th>
        <th>Category</th>
        <th>Title</th>
        <th>Description</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
    {
        products.map(product => 
      <>
      <tr>        
        <td>{product.author_name}</td>
        <td>{product.category_name}</td>
        <td>{(product.title).split(" ").slice(0, 4).join(" ")}..</td>
        <td>{(product.description).split(" ").slice(0, 4).join(" ")}..</td>
        <td>   
          {
            user.role==0? <>
            <button
                      onClick={() => preEdit(product.id)}
                      className="btn btn-info btn-xs mr-2"
                    >
                      <label htmlFor="my-modal2">Edit</label>
                    </button>
                    <button
                      onClick={() => preDelete(product.id)}
                      className="btn btn-error btn-xs mr-2"
                    >
                      Delete
                    </button>
            </>  :
            user.role == 1 ? <></> :
            user.role == "2" ? <>
             <button
                      onClick={() => preEdit(product.id)}
                      className="btn btn-info btn-xs mr-2"
                    >
                      <label htmlFor="my-modal2">Edit</label>
                    </button>
            </>: <></>
        }   
        </td>
      </tr>
      </>)
      }
    </tbody> 
  </table> */}
      <div className="flex flex-wrap">
        {products.map((product) => (
          <>
            <div className="flex justify-between">
              <div className="card w-96 bg-primary text-dark-content m-4 p-3">
                <div className="card-body ">
                  <h2 className="card-title text-red-700">
                    Title : {product.title.split(" ").slice(0, 4).join(" ")}
                  </h2>
                  <h4>Author : {product.author_name}</h4>
                  <h4>Category : {product.category_name}</h4>
                </div>
                <h2 className="text-red-500">Description </h2>
                <h3 >
                  {product.description.split(" ").slice(0, 28).join(" ")}..
                </h3>
                <div class="flex justify-around mt-3">
                  {userRole == 0 ? (
                    <>
                      <button
                        onClick={() => preEdit(product.id)}
                        className="btn btn-warning btn-xs mr-2"
                      >
                        <label htmlFor="my-modal2">Edit</label>
                      </button>
                      <button
                        onClick={() => preDelete(product.id)}
                        className="btn btn-error btn-xs mr-2"
                      >
                        Delete
                      </button>
                    </>
                  ) : userRole == 1 ? (
                    <></>
                  ) : userRole == 2 ? (
                    <>
                      <button
                        onClick={() => preEdit(product.id)}
                        className="btn btn-warning btn-xs mr-2"
                      >
                        <label htmlFor="my-modal2">Edit</label>
                      </button>
                    </>
                  ) : (
                    <></>
                  )}
                </div>
              </div>
            </div>
          </>
        ))}
      </div>
      {/* finish card  */}
    </div>
  );
};
export default Posts;
