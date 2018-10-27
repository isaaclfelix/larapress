import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import tinymce from 'tinymce';

export default class TinyMCE extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: post.id,
            parent: post.parent,
            author: post.author,
            type: post.type,
            status: post.status,
            title: post.title,
            route: post.route,
            autoroute: post.route === "" ? true : false,
            content: post.content,
            excerpt: post.excerpt
        };

        this.handleInputChange = this.handleInputChange.bind(this);
        this.toggleRouteEdit = this.toggleRouteEdit.bind(this);
    }

    componentDidMount() {
        tinymce.init({
            selector: '.rich-editor',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste help wordcount'
            ],
            toolbar: 'undo redo | fontsizeselect formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        });
    }
    render() {
        return (
            <div className="inputs">
                <input type="hidden" name="id" value={this.state.id} onChange={this.handleInputChange} />
                <input type="hidden" name="parent" value={this.state.parent} onChange={this.handleInputChange} />
                <input type="hidden" name="author" value={this.state.author} onChange={this.handleInputChange} />
                <input type="hidden" name="type" value={this.state.type} onChange={this.handleInputChange} />
                <input type="hidden" name="status" value={this.state.status} onChange={this.handleInputChange} />
                <div className="form-group">
                    <label>Title</label>
                    <input value={this.state.title} id="post-title" name="title" type="text" className="form-control" onChange={this.handleInputChange} />
                </div>
                <div className="form-group">
                    <label>
                        Route
                        {(post.route !== "" || this.state.route !== "") &&
                        <button onClick={this.toggleRouteEdit} className="ml-2 btn btn-sm btn-primary" type="button">
                            { this.state.autoroute === false &&
                                "Edit"
                            }
                            { this.state.autoroute === true &&
                                "Save"
                            }
                        </button>
                        }
                    </label>
                    <input value={this.state.route} type="text" name="route" id="post-route" className="form-control" onChange={this.handleInputChange} readOnly={!this.state.autoroute} />
                </div>
                <div className="form-group">
                    <label>Content</label>
                    <textarea name="content" id="content" className="rich-editor form-control" value={this.state.content} onChange={this.handleInputChange} />
                </div>
                <div className="form-group">
                    <label>Excerpt</label>
                    <textarea name="excerpt" id="excerpt" className="rich-editor form-control" value={this.state.excerpt} onChange={this.handleInputChange} />
                </div>
                <button className="btn btn-primary" type="submit">Save Post</button>
            </div>
        );
    }

    toggleRouteEdit(event) {
        if (this.state.autoroute === false) {
            this.setState({ autoroute: true });
        }
        else {
            this.setState({ autoroute: false });
        }
    }

    handleInputChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;
        this.setState({
            [name]: value
        });
        if (name === 'title' && this.state.autoroute === true) {
            this.setState({
                route: this.slugify(value)
            });
        }
    }
    slugify(string) {
        const a = 'àáäâãåèéëêìíïîòóöôùúüûñçßÿœæŕśńṕẃǵǹḿǘẍźḧ·/_,:;'
        const b = 'aaaaaaeeeeiiiioooouuuuncsyoarsnpwgnmuxzh------'
        const p = new RegExp(a.split('').join('|'), 'g')
        return string.toString().toLowerCase()
            .replace(/\s+/g, '-') // Replace spaces with
            .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
            .replace(/&/g, '-and-') // Replace & with ‘and’
            .replace(/[^\w\-]+/g, '') // Remove all non-word characters
            .replace(/\-\-+/g, '-') // Replace multiple — with single -
            .replace(/^-+/, '') // Trim — from start of text .replace(/-+$/, '') // Trim — from end of text
    }
}

if (document.getElementById('add-new-post-form')) {

    ReactDOM.render(<TinyMCE />, document.getElementById('add-new-post-form'));
}
