import React from "react";
import './item.scss';

export default class Item extends React.Component {
	render() {	

		const post = this.props.post;
		let img = ''; 
		let alt = '';
		if(post._embedded['wp:featuredmedia']) {
			img = post._embedded['wp:featuredmedia']['0']['media_details']['sizes']['thumbnail']['source_url'];
			alt = post._embedded['wp:featuredmedia']['0'].alt_text;
		}

		return (
			<li className="postsloader__item">
				<a href={post.link}>
					<img className="postsloader__img" src={img} alt={alt}/>
					<div className="postsloader__title">
						{post.title.rendered}
					</div>		
				</a>
			</li>
		)

	}
}