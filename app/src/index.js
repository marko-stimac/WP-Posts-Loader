import React from "react"; 
import ReactDOM from "react-dom";
import PostsLoader from "./components/PostsLoader";

document.querySelectorAll('.postsloader').forEach(el => {
	let data = 'postsloader_' + el.getAttribute('data-id');
	ReactDOM.render(<PostsLoader data={data} />, el); 
});