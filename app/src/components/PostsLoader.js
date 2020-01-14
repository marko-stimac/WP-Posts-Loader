import React from 'react';
import axios from 'axios';
import './loader.scss';
import './postsloader.scss';
import ArrowLeft from './arrow-left.svg';
import ArrowRight from './arrow-right.svg';
import Item from './Item';

export default class Posts extends React.Component {

	state = {
		posts: [],
		url: '', 
		visiblePosts: '',
		scrollBy: '',
		currentOffset: 0,
		isLoading: true
	};

	/**
	 * Handles pagination buttons
	 */
	handlePagination(e, direction) {
		// If prev button is clicked decrease offset until 0
		if (direction === 'prev') {
			this.setState({
				currentOffset:
					this.state.currentOffset - this.state.scrollBy
			});
		}
		// If next button is clicked increase offset
		else {
			this.setState({
				currentOffset:
					this.state.currentOffset + this.state.scrollBy
			});
		}
	}

	/**
	 * Initialize
	 */
	componentDidMount() {
		// Set state with additional data and after that fetch data
		this.setState({
			isLoading: true,
			url: window[this.props.data].url,
			visiblePosts: parseInt(window[this.props.data].visible_posts),
			scrollBy: parseInt(window[this.props.data].scroll_by),
		}, () => {
			axios.get(this.state.url).then(res => {
				this.setState({
					posts: res.data,
					isLoading: false
				});
			});
		})

	}
	render() {
		if (this.state.isLoading) {
			return <div className="loader"><div></div></div>
		} else {
			const items = [];
			for (
				let i = this.state.currentOffset;
				i < this.state.posts.length;
				i++
			) {
				if (items.length >= this.state.visiblePosts) {
					break;
				}
				items.push(
					<Item
						post={this.state.posts[i]}
						key={this.state.posts[i].id}
					/>
				);
			}
			return (
				<div>
					<ul className="postsloader__items">{items}</ul>
					<nav className="postsloader__nav">
						<button
							className="btn postsloader__btn postsloader__btn--prev"
							disabled={
								this.state.currentOffset === 0
									? 'disabled'
									: ''
							}
							onClick={e =>
								this.handlePagination(e, 'prev')
							}
						>
							<ArrowLeft />
						</button>

						<button
							className="btn postsloader__btn postsloader__btn--next"
							disabled={
								this.state.posts.length <= this.state.currentOffset +  this.state.visiblePosts
									? 'disabled'
									: ''
							}
							onClick={e =>
								this.handlePagination(e, 'next')
							}
						>
							<ArrowRight />
						</button>
					</nav>
				</div>
			);
		}
	}
}
